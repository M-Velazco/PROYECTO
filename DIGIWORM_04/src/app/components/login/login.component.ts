import { Component,ElementRef, OnInit  } from '@angular/core';
import { LoginService } from './login.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  usuarios:any;

  user={
    Idusuarios:0,
    Nombre_apellido:"",
    Correo:"",
    Telefono:0,
    Contrasena:"",
    Rol:""
  }

  private container: HTMLElement | null;

  constructor(private elementRef: ElementRef) {
    this.container = null;
  }

  ngOnInit() {
    this.container = this.elementRef.nativeElement.querySelector('.container');
  }

  switchToSignUp() {
    if (this.container) {
      this.container.classList.add('sign-up-mode');
    }
  }

  switchToSignIn() {
    if (this.container) {
      this.container.classList.remove('sign-up-mode');
    }
  }
}
