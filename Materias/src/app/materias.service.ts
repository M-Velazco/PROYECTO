import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MateriasService {

  url = 'http://localhost/iv-Trimestre/Materias/src/app/crud/php/';

  constructor(private http: HttpClient) { }

  Create(Materias:any){
    return this.http.post(`${this.url}Create.php`,JSON.stringify(Materias));
  }
  
  Read(){
    return this.http.get(`${this.url}Read.php`);
  }

  Update(Materias:any) {
    return this.http.post(`${this.url}Update.php`, JSON.stringify(Materias)); 
  }

  Delete(idMateria:number){
    return this.http.get(`${this.url}Delete.php?idMateria=${idMateria}`);
  }

  Select(idMateria:number){
    return this.http.get(`${this.url}Select.php?idMateria=${idMateria}`);
  }
}
