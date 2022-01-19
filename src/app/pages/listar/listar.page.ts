import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ModalController, NavController } from '@ionic/angular';
import { ApiService } from "../api.service";

@Component({
  selector: 'app-listar',
  templateUrl: './listar.page.html',
  styleUrls: ['./listar.page.scss'],
})
export class ListarPage implements OnInit {
  public items : any = [];

  ionViewWillEnter(){
    this.givePokemon();
  }

  constructor(public _apiService: ApiService, private nav: NavController,private router: Router) {}
  
  givePokemon(){
    this._apiService.givePokemon().subscribe((data) => {
      this.items = data;
    });
  }

  deletePokemon(id_item, id_imagen){
    var data = new FormData();
    data.append("id", id_item);
    data.append("imagen", id_imagen);

    this._apiService.deletePokemon(data).subscribe((response) => {
      console.log(response);
      //recargar la pagina
      window.location.reload();
    });
  }
  
  editar(item) {
    //this.router.navigate(['/editar/'], item)
    if (item){
      this.router.navigate(['editar'], { state: { id: item } });
    }
  }

  ngOnInit() {
  }

}
