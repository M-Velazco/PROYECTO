import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './articulos.service';

@Component({
  selector: 'app-docentes',
  templateUrl: './docentes.component.html',
  styleUrls: ['./docentes.component.css']
})
export class DocentesComponent implements OnInit {
  title = 'docentes';
  articulos: any;

  // Simplificamos el modelo para incluir solo idmaterias y nom_materia
  art = {
    idDocente:0,
    Nombres:"",
    Apellidos:"",
    Email:"",
    Pasword:"",
    Curso:0,
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

  baja(idDocente: number) {
    this.articulosServicio.baja(idDocente).subscribe((datos: any) => {
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

  seleccionar(idDocente: number) {
    this.articulosServicio.seleccionar(idDocente).subscribe((result: any) => this.art = result[0]);
  }

  hayRegistros() {
    return true;
  }
}
