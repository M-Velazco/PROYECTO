import { Component, OnInit } from '@angular/core';
import { ArticulosService } from './articulos.service';
// En tu componente.ts
export class TuComponente {
  terminoBusqueda: any;
  articulos: any;
  // Otras propiedades y métodos existentes

  // Método que filtra los artículos según el término de búsqueda
  public filtrarArticulos(): void {
    if (this.terminoBusqueda.trim() !== '') {
      // Filtra los artículos según el término de búsqueda
      this.articulos = this.articulos.filter((articulo: { descripcion: string; }) =>
        articulo.descripcion.toLowerCase().includes(this.terminoBusqueda.toLowerCase())
      );
    } else {
      // Si el término de búsqueda está vacío, muestra todos los artículos nuevamente
      // Aquí podrías realizar una nueva solicitud al servidor para obtener todos los artículos
    }
  }
}

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
est_rep: any;
  title(title: any) {
    throw new Error('Method not implemented.');
  }

  articulos:any;

  art={
    codigo:0,
    idpadre_de_familia:"",
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

  baja(codigo:number) {
    this.articulosServicio.baja(codigo).subscribe((datos:any) => {
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

  seleccionar(codigo:number) {
    this.articulosServicio.seleccionar(codigo).subscribe((result:any) => this.art = result[0]);
  }

  hayRegistros() {
    return true;
  }

}
