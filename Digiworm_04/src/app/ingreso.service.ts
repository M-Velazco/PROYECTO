import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ingresoService {
  url='http://localhost/Digiworm_04/login/src/app/components/registro/php/'; // disponer url de su servidor que tiene las páginas PHP
  constructor(private http: HttpClient) { }




alta(usuarios:any) {
  return this.http.post(`${this.url}alta.php`, JSON.stringify(usuarios));
}
}