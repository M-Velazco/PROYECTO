// app.component.ts

import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './includes.service';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs/internal/Observable';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  
  actividad: any;
  act = {
    idactividades: 0,
    Nom_act: "",
    Materia_act: 0,
    Docente: 0,
    Archivo: ""
  };
  
  constructor(private articulosServicio: ArticulosService, private http: HttpClient) {}

  ngOnInit(): void {
    this.Read();
  }

  Read() {
    this.articulosServicio.Read().subscribe((result: any) => this.actividad = result);
  }
  seleccionarActividad(id: number) {
    // Lógica para seleccionar una actividad
  }
  borrarActividad(id: number) {
    // Lógica para borrar una actividad
  }
  descargarArchivo(idactividades: number, nombreArchivo: string) {
    this.articulosServicio.Download(idactividades).subscribe(
      (data: any) => this.handleDescargaArchivo(data, nombreArchivo),
      error => this.handleErrorDescarga(error)
    );
  }
  
  private handleDescargaArchivo(data: any, nombreArchivo: string) {
    const blob = new Blob([data], { type: 'application/octet-stream' });
    const url = window.URL.createObjectURL(blob);
    this.crearYDispararDescarga(url, nombreArchivo);
    this.limpiarRecursos(url);
  }
  
  private crearYDispararDescarga(url: string, nombreArchivo: string) {
    const a = document.createElement('a');
    a.href = url;
    a.download = nombreArchivo;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }
  
  private limpiarRecursos(url: string) {
    window.URL.revokeObjectURL(url);
  }
  
  private handleErrorDescarga(error: any) {
    console.error('Error al descargar el archivo', error);
  }

  title = 'Actividades';

  create() {
    this.articulosServicio.Create(this.act).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.Read();
      }
    });
  }

  delete() {
    // Implement delete functionality if needed
  }

  hayRegistros() {
    return true;
  } 

  mostrarBotonAgregar = true;

  ocultarBotonAgregar() {
    this.mostrarBotonAgregar = false;
  }
}
