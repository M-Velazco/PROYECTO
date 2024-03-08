import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './articulos.service';
// En tu componente.ts


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
est_rep: any;
 

  articulos:any;

  art={

    idpadre_de_familia:0,
    est_rep:"",
    estado_matr:0

  }

  constructor(private articulosServicio: ArticulosService) {}

  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.articulosServicio.recuperarTodos().subscribe((result:any) => this.articulos = result);
  }

  alta() {
    this.articulosServicio.alta(this.art).subscribe((datos:any) => {
      if (datos['resultado']=='OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(idpadre_de_familia:number) {
    this.articulosServicio.baja(idpadre_de_familia).subscribe((datos:any) => {
      if (datos['resultado']=='OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.articulosServicio.modificacion(this.art).subscribe((datos:any) => {
      if (datos['resultado']=='OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(idpadre_de_familia:number) {
    this.articulosServicio.seleccionar(idpadre_de_familia).subscribe((result:any) => this.art = result[0]);
  }

  hayRegistros() {
    return true;
  }

}
