import { Component, OnInit } from '@angular/core';
import { ApiService } from "../api.service";

@Component({
  selector: 'app-formulario',
  templateUrl: './formulario.page.html',
  styleUrls: ['./formulario.page.scss'],
})
export class FormularioPage implements OnInit {

  //declaramos variables
  id;
  nombre;
  tipo;
  habilidades;
  tamano;
  imatge;

  //creamos una funcios
  addPokemon(){
    var data = new FormData();
    data.append("nombre", this.nombre);
    data.append("tipo", this.tipo);
    data.append("habilidades", this.habilidades);
    data.append("tamano", this.tamano);
    data.append('imatge', this.imatge);
    
    //console.log(data.nombre, data.tipo, data.habilidades, data.tamano);

    //llamamos a la api
    this._apiService.addPokemon(data).subscribe((response) => {
      console.log(response);

      //recargar la pagina
      window.location.reload();
    });

  }


  selectedFile(event){
    this.imatge = event.target.files[0];
  }


  constructor(public _apiService: ApiService) { }

  ngOnInit() {
  }
}
