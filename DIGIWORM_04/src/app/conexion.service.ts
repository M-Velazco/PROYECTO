import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ConexionService {


    private apiUrl = 'http://tu-servidor-php.com'; // Actualiza con la URL de tu servidor PHP

    constructor(private http: HttpClient) {}

    login(email: string, password: string): Observable<any> {
      const formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);

      return this.http.post({}/tu-ruta-de-login.php, formData);
    }
}



