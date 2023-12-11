import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private baseUrl = 'http://localhost/proyecto/PROYECTO/DIGIWORM_04/src/app/components/login/php/'; // Reemplaza con la URL de tu servidor

  constructor(private http: HttpClient) {}

  login(Idusuario: number, contrasena: string): Observable<any> {
    const url = `${this.baseUrl}login.php`;
    const body = { Idusuario: Idusuario, Contraseña: contrasena };
    return this.http.post(url, body);
  }
}
