import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CursoService {

  url = 'http://localhost/Backend/Curso/';

  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.get(`${this.url}recuperartodos.php`);
  }

  alta(curso: any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(curso));
  }

  baja(idcurso: number) {
    return this.http.get(`${this.url}baja.php?idcurso=${idcurso}`);
  }

  seleccionar(idcurso: number) {
    return this.http.get(`${this.url}seleccionar.php?idcurso=${idcurso}`);
  }

  modificacion(curso: any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(curso));
  }
}
