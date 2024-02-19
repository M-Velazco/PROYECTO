// login.component.ts

import { Component, ElementRef, OnInit } from '@angular/core';
import { LoginService } from './login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  Idusuarios!: number;
  Contrasena!: string;

  private container: HTMLElement | null;

  constructor(private elementRef: ElementRef, private loginService: LoginService, private router: Router) {
    this.container = null;
  }

  onSubmit() {
    this.loginService.login(this.Idusuarios, this.Contrasena).subscribe(
      (data) => {
        // Manejar la respuesta del servidor (éxito o error)
        if (data.success) {
          // La autenticación fue exitosa, redirigir al usuario a la página deseada
          console.log("Autenticación exitosa");
          // Redirigir al usuario a la página deseada
          this.router.navigate(['']);
        } else {
          // La autenticación falló, mostrar un mensaje de error al usuario
          console.error("Error de autenticación:", data.message);
          // Puedes mostrar un mensaje de error al usuario si lo deseas
          // this.errorMessage = data.message;
        }
      },
      (error) => {
        // Manejar errores de la solicitud
        console.error("Error al procesar la solicitud:", error);
      }
    );
  }

  Register(){}

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
