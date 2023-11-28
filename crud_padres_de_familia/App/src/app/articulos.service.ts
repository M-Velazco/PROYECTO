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

  alta(articulos:any) {
    return this.http.post(`${this.Url}alta.php`, JSON.stringify(articulos));
  }

  baja(idpadre_de_familia:number) {
    return this.http.get(`${this.Url}baja.php?codigo=${idpadre_de_familia}`);
  }

  seleccionar(idpadre_de_familia:number) {
    return this.http.get(`${this.Url}seleccionar.php?codigo=${idpadre_de_familia}`);
  }

  modificacion(articulos:any) {
    return this.http.post(`${this.Url}modificacion.php`, JSON.stringify(articulos));
  }
}
