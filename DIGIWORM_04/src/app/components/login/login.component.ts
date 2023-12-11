import { Component, ElementRef, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { LoginService } from './login.service';
import { Subscription } from 'rxjs';

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
      idusuarios: [0, Validators.required],
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
      const { idusuarios, Contrasena } = this.loginForm.value;

      this.loginService.login(idusuarios, Contrasena).subscribe({
        next: (response: any) => {
          console.log('Login successful', response);
          // Handle the response here
        },
        error: (error: any) => {
          console.error('Login failed', error);
          // Handle errors here
        }
      });
    }
  }
}
