import { Component, OnInit } from '@angular/core';
import { ApiService } from "../api.service";
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-editar',
  templateUrl: './editar.page.html',
  styleUrls: ['./editar.page.scss'],
})
export class EditarPage implements OnInit {
  id;
  nombre;
  tipo;
  habilidades;
  tamano;
  imatge;

  public items : any = [];

  constructor(private router: Router, public _apiService: ApiService) { 
    this.id = this.router.getCurrentNavigation().extras.state.id;
    console.log(this.id);

    var data = new FormData();
    data.append("id", this.id);
    this._apiService.giveDetailPokemon(data).subscribe((response) => {
      console.log(response);
      this.items = response;

      for(let i=0; i<this.items.length; i++){
        this.nombre = this.items[i].nombre;
        this.tipo = this.items[i].tipo;
        this.habilidades = this.items[i].habilidades;
        this.tamano = this.items[i].tamano;
      }
    });
    
  }


  editarPokemon(){
    var data = new FormData();
    data.append("id", this.id);
    data.append("nombre", this.nombre);
    data.append("tipo", this.tipo);
    data.append("habilidades", this.habilidades);
    data.append("tamano", this.tamano);
    data.append('imatge', this.imatge);

    //llamamos a la api
    this._apiService.editarPokemon(data).subscribe((response) => {
      console.log(response);

      //recargar la pagina
      this.router.navigate(['/listar/'])
    });
  }

  selectedFile(event){
    this.imatge = event.target.files[0];
  }

  ngOnInit() {
  }

}
