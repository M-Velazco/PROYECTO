import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RegistroService {

  url='http://localhost/proyecto/login/src/app/components/registro/php/'; // disponer url de su servidor que tiene las páginas PHP

  constructor(private http: HttpClient) { }

  

  alta(articulo:any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(articulo));    
  }
}
