import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RegistroService {
  private apiUrl = 'http://localhost/iv-Trimestre/login/src/app/registro/php/';  // Ajusta la URL según la ubicación de tu servidor

  constructor(private http: HttpClient) {}

  alta(usuarios: any) {
    return this.http.post(`${this.apiUrl}alta.php`, usuarios);
  }

  seleccionar(idusuarios: number) {
    return this.http.get(`${this.apiUrl}seleccionar.php?codigo=${idusuarios}`);
  }
}
