import { Component } from '@angular/core';
import { MateriasService } from '../materias.service';
import { Location } from '@angular/common';

@Component({
  selector: 'app-crud',
  templateUrl: './crud.component.html',
  styleUrls: ['./crud.component.css']
})
export class CrudComponent {
Materias: any;

Materia={
  idMateria:0,
  Nom_materia:""
}

constructor(private MateriasServicio:MateriasService,private location: Location){}

ngOnInit(){
  this.Read();
}

Create(){
  this.MateriasServicio.Create(this.Materia).subscribe((datos:any) => {
    if (datos['resultado']=='OK') {
      alert(datos['mensaje']);
      this.Read();
      this.location.go(this.location.path());
    }
  });
}

Read(){
  this.MateriasServicio.Read().subscribe((result:any) => this.Materias = result);
}
hayRegistros() {
    return true;
    
  } 
}
