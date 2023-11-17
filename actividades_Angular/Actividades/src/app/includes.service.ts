// includes.service.ts

import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ArticulosService {

  private url = 'http://localhost/iv-Trimestre/actividades_Angular/Actividades/src/app/act-app/includes/views/';
  private urld = '/api/';

  constructor(private http: HttpClient) { }

  Read() {
    return this.http.get(`${this.url}index.php`);
  }

  Create(actividad: any) {
    return this.http.post(`${this.url}upload.php`, JSON.stringify(actividad));    
  }

  // includes.service.ts

  Download(idactividades: number): Observable<any> {
    const url = `${this.url}download.php?idactividades=${idactividades}`;
    return this.http.get(url, { responseType: 'blob' });
  }


  baja(codigo: number) {
    return this.http.get(`${this.url}baja.php?codigo=${codigo}`);
  }
  
  seleccionar(codigo: number) {
    return this.http.get(`${this.url}seleccionar.php?codigo=${codigo}`);
  }

  modificacion(articulo: any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(articulo));    
  } 
}
