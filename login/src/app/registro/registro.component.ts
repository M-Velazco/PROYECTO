import { Component } from '@angular/core';
import { RegistroService } from './registro.service';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class RegistroComponent {
  usuarios: any;

  user={
    Idusuarios:0,
    Nombre_apellido:"",
    Correo:"",
    Telefono:0,
    Contrasena:"",
    Rol:""
  }

  constructor(private registroservicio:RegistroService){}

  alta(){
    this.registroservicio.alta(this.user).subscribe((datos:any)=>{
      if (datos['resultados']=='ok'){
        alert(datos['mensaje']);
      }
    });
  }
}
