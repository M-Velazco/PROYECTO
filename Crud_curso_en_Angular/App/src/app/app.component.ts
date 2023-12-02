import { Component, OnInit } from '@angular/core';
import { CursoService } from './curso.service';  

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title(title: any) {
    throw new Error('Method not implemented.');
  }

  cursos: any;

  curso = {
    idcurso: 0,
    nom_curso: '',
    estado: 'Activo' 
  };

  constructor(private cursosServicio: CursoService) { }

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.cursosServicio.recuperarTodos().subscribe((result: any) => this.cursos = result);
  }

  alta() {
    this.cursosServicio.alta(this.curso).subscribe((datos: any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(idcurso: number) {
    this.cursosServicio.baja(idcurso).subscribe((datos: any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.cursosServicio.modificacion(this.curso).subscribe((datos: any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(idcurso: number) {
    this.cursosServicio.seleccionar(idcurso).subscribe((result: any) => this.curso = result[0]);
  }

  hayRegistros() {
    return this.cursos && this.cursos.length > 0;
  }
}
