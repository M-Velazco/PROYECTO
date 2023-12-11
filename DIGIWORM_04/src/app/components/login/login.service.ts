import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private apiUrl = 'http://localhost/proyecto/PROYECTO/DIGIWORM_04/src/app/components/login/php/login.php'; // Reemplaza con la URL de tu servidor

  constructor(private http: HttpClient) {}

  login(idusuarios: number, Contrasena: string): Observable<any> {
    const data = { idusuarios, Contrasena };
    return this.http.post(this.apiUrl, data);
  }

}
