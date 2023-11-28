import { Component } from '@angular/core';
import { RegistroService } from './registro.service';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Router } from '@angular/router';


@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css'],
  animations: [
    trigger('slideInOut', [
      state('in', style({ transform: 'translateX(0)' })),
      state('out', style({ transform: 'translateX(100%)' })),
      transition('in => out', animate('300ms ease-in-out')),
      transition('out => in', animate('300ms ease-in-out')),
    ]),
  ],
  
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
  showRegisterForm = false;

  toggleForm() {
    this.showRegisterForm = !this.showRegisterForm;
  }

  constructor(private registroservicio:RegistroService,private router: Router){}

  alta(){
    this.registroservicio.alta(this.user).subscribe((datos:any)=>{
      if (datos['resultados']=='ok'){
        alert(datos['mensaje']);
      }
    });
  }

  login() {
    this.registroservicio.seleccionar(this.user.Idusuarios, this.user.Contrasena).subscribe(
      (response: any) => {
        // Handle the response from the service here
        if (response && response.success) {
          // Authentication successful
          this.onLoginSuccess();
        } else {
          // Authentication failed
          console.error('Authentication error:', response);
        }
      },
      (error) => {
        // Handle authentication error here
        console.error('Authentication error:', error);
      }
    );
  }
  
  onLoginSuccess() {
    // If authentication is successful, navigate to the desired component
    this.router.navigate(['/login']); // Replace 'dashboard' with the desired route
  }
  
}
