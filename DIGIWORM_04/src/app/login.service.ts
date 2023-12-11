import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  url='http://localhost/proyecto/PROYECTO/DIGIWORM_04/src/app/components/login/php/'; // disponer url de su servidor que tiene las páginas PHP

  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.get(`${this.url}recuperartodos.php`);
  }

  alta(articulo:any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(articulo));    
  }

  baja(idmaterias: number) {
    return this.http.get(`${this.url}baja.php?idmaterias=${idmaterias}`);
  }
  
  
  seleccionar(idusuarios:number) {
    return this.http.get(`${this.url}login.php?IdU=${idusuarios}`);
  }

  modificacion(articulo:any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(articulo));    
  } 
}