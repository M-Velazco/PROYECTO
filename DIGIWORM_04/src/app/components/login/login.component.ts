// login.component.ts

import { Component, ElementRef, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { LoginService } from './login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;

  private container: HTMLElement | null;

  constructor(
    private elementRef: ElementRef,
    private loginService: LoginService,
    private fb: FormBuilder
  ) {
    this.container = null;
    this.loginForm = this.fb.group({
      Idusuario: [0, Validators.required],
      Contrasena: ['', Validators.required]
    });
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

  login() {
    if (this.loginForm.valid) {
      const { Idusuario, Contrasena } = this.loginForm.value;
  
      this.loginService.login(Idusuario, Contrasena).subscribe(
        (response) => {
          console.log('Login successful', response);
          // Aquí puedes manejar la respuesta del servicio, redireccionar, etc.
        },
        (error) => {
          console.error('Login failed', error);
          // Aquí puedes manejar errores, como mostrar un mensaje al usuario
        }
      );
    }
  }
  
}
