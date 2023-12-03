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
    nom_curso: '',
    estado: 'Activo'
  };

  edicionHabilitada = true;

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
        this.resetForm();
      }
    });
  }

  modificacion() {
    this.cursosServicio.modificacion(this.curso).subscribe((datos: any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
        this.resetForm();
      }
    });
  }

  seleccionar(idcurso: number) {
    this.cursosServicio.seleccionar(idcurso).subscribe((result: any) => {
      this.curso = { ...result[0] };
      this.edicionHabilitada = false;
    });
  }

  hayRegistros() {
    return this.cursos && this.cursos.length > 0;
  }

  resetForm() {
    this.curso = {
      idcurso: 0,
      nom_curso: '',
      estado: 'Activo'
    };
    this.edicionHabilitada = true;
  }
}
