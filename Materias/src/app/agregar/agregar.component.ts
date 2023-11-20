import { Component } from '@angular/core';
import { MateriasService } from '../materias.service';
import { Location } from '@angular/common';

@Component({
  selector: 'app-agregar',
  templateUrl: './agregar.component.html',
  styleUrls: ['./agregar.component.css']
})
export class AgregarComponent {
  Materias: any[] = [];

  Materia = {
    idMateria: 0,
    Nom_materia: ""
  };

  constructor(private MateriasServicio: MateriasService, private location: Location) {}

  ngOnInit() {
    this.Read();
  }

  Create() {
    this.MateriasServicio.Create(this.Materia).subscribe(
      (datos: any) => {
        if (datos['resultado'] == 'OK') {
          alert(datos['mensaje']);
          this.Read(); // Actualizar la lista después de la creación
          this.location.go(this.location.path());
        } else {
          // Manejar casos de error aquí
          console.error('Error en la creación:', datos['mensaje']);
        }
      },
      error => {
        // Manejar errores de la solicitud HTTP aquí
        console.error('Error en la solicitud HTTP:', error);
      }
    );
  }

  Read() {
    this.MateriasServicio.Read().subscribe(
      (result: any) => {
        this.Materias = result;
      },
      error => {
        // Manejar errores de la solicitud HTTP aquí
        console.error('Error en la solicitud HTTP:', error);
      }
    );
  }

  hayRegistros() {
    // Lógica para determinar si hay registros
    return this.Materias.length > 0;
  }
}
