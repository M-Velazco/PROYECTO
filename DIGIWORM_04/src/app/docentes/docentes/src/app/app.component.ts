import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './articulos.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'docentes';
  articulos: any;

  // Simplificamos el modelo para incluir solo idmaterias y nom_materia
  art = {
    iddocente:0,
    Nombre_apellido:"",
    Correo:"",
    Contrasena:"",
    Curso_pr:0,
    Materia:0
  };

  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.articulosServicio.recuperarTodos().subscribe((result: any) => this.articulos = result);
  }

  alta() {
    this.articulosServicio.alta(this.art).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(iddocente: number) {
    this.articulosServicio.baja(iddocente).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.articulosServicio.modificacion(this.art).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(iddocente: number) {
    this.articulosServicio.seleccionar(iddocente).subscribe((result: any) => this.art = result[0]);
  }

  hayRegistros() {
    return true;
  }
}
