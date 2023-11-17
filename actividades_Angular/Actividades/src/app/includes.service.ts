import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ArticulosService {

  url='http://localhost/iv-Trimestre/actividades_Angular/Actividades/src/app/act-app/includes/views/'; // disponer url de su servidor que tiene las páginas PHP// http://localhost/iv-Trimestre/actividades_Angular/Actividades/src/app/includes/views/ */

  constructor(private http: HttpClient) { }

  Read() {
    return this.http.get(`${this.url}index.php`);
  }

  alta(articulo:any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(articulo));    
  }

  baja(codigo:number) {
    return this.http.get(`${this.url}baja.php?codigo=${codigo}`);
  }
  
  seleccionar(codigo:number) {
    return this.http.get(`${this.url}seleccionar.php?codigo=${codigo}`);
  }

  modificacion(articulo:any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(articulo));    
  } 
}