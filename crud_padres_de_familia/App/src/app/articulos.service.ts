import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ArticulosService {

 Url = 'http://localhost/php1/'; // Asegúrate de cambiar el puerto según tu configuración
 // disponer url de su servidor que tiene las páginas PHP

  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.get(`${this.Url}recuperartodos.php`);
  }

  alta(articulo:any) {
    return this.http.post(`${this.Url}alta.php`, JSON.stringify(articulo));
  }

  baja(codigo:number) {
    return this.http.get(`${this.Url}baja.php?codigo=${codigo}`);
  }

  seleccionar(codigo:number) {
    return this.http.get(`${this.Url}seleccionar.php?codigo=${codigo}`);
  }

  modificacion(articulo:any) {
    return this.http.post(`${this.Url}modificacion.php`, JSON.stringify(articulo));
  }
}
