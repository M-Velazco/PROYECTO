import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RegistroService {
  private apiUrl = 'http://localhost/iv-Trimestre/login/src/app/registro/php/';  // Ajusta la URL según la ubicación de tu servidor

  constructor(private http: HttpClient) {}

  alta(usuarios: any) {
    return this.http.post(`${this.apiUrl}alta.php`, usuarios);
  }

  seleccionar(Idusuarios: number, Contrasena: string): Observable<any> {
    // Realiza una solicitud HTTP al servicio PHP de autenticación
    const body = { Idusuarios: Idusuarios, Contrasena: Contrasena };
    return this.http.post(`${this.apiUrl}login.php`, body);
  }
  
}
