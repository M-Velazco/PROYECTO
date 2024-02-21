import { Injectable } from '@angular/core';
import { HttpClient, HttpParams  } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private apiUrl = 'http://localhost/PROYECTO/DIGIWORM_04/src/app/components/login/php/login.php';

  constructor(private http: HttpClient) {}

  login(idusuarios: number, Contrasena: string): Observable<any> {
    // Construir parámetros de la solicitud GET
    const params = new HttpParams().set('Idusuarios', idusuarios.toString()).set('Contrasena', Contrasena);

    // Agregar parámetros a la URL
    const url = `${this.apiUrl}?${params.toString()}`;

    // Realizar la solicitud GET
    return this.http.get(url);
  }
}
