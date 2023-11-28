import { Component } from '@angular/core';
import { ArticulosService } from '../articulos.service';

@Component({
  selector: 'app-padres',
  templateUrl: './padres.component.html',
  styleUrls: ['./padres.component.css']
})
export class PadresComponent {
  
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
    

