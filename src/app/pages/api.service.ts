import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  constructor(public http: HttpClient) { 
    
  }

  addPokemon(data){
    return this.http.post('http://localhost/backend/insert.php', data);
  }

  editarPokemon(data){
    return this.http.post('http://localhost/backend/editar.php', data);
  }

  givePokemon(){
    return this.http.get('http://localhost/backend/read.php');
  }

  deletePokemon(id){
    return this.http.post('http://localhost/backend/eliminar.php', id);
  }

  giveDetailPokemon(id){
    return this.http.post('http://localhost/backend/detail.php', id);
  }
}
