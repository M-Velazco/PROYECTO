import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './includes.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  
  actividad:any;
  act={
    idactividades:0,
    Nom_act:"",
    Materia_act:0,
    Docente:0,
    Archivo:""
  }
  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit(): void {
    this.Read();
  }

  Read(){
    this.articulosServicio.Read().subscribe((result:any) => this.actividad = result)
  }
  title = 'Actividades';

  create(){
    this.articulosServicio.alta(this.act).subscribe((datos:any) => {
      if (datos['resultado']=='OK') {
        alert(datos['mensaje']);
        this.Read();
      }
    });
  }

  delete(){

  }
  hayRegistros() {
    return true;
  } 
  mostrarBotonAgregar = true;
  ocultarBotonAgregar() {
    this.mostrarBotonAgregar = false;
  }
}
