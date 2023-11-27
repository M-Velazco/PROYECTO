import { Component, OnInit } from '@angular/core';
import { CursoService } from './curso.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

  cursos: any;
  
  curso = {
    idcurso: 0,
    nom_curso: "",
    estado: ""
  };

  constructor(private cursoServicio: CursoService) {}

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.cursoServicio.recuperarTodos().subscribe((result: any) => this.cursos = result);
  }

  alta() {
    this.cursoServicio.alta(this.curso).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(idcurso: number) {
    this.cursoServicio.baja(idcurso).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  editar(idcurso: number) {
    this.cursoServicio.editar(idcurso).subscribe((result: any) => this.curso = result[0]);
  }

  modificacion() {
    this.cursoServicio.modificacion(this.curso).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });    
  }
  
  hayRegistros() {
    return true;
  } 
}
