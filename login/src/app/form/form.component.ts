import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrl: './form.component.css'
})
export class FormComponent {
  Idusaurio: number = 0;
  password: string = "";
  message: string = "";

  constructor(private http: HttpClient) {}

  login(): void {
    // Realiza la solicitud HTTP al archivo PHP para la autenticación
    const url = 'http://localhost/iv-Trimestre/login/src/app/form/php/login.php';
    const data = { idUsuario: this.Idusaurio, contrasena: this.password };

    this.http.post(url, data).subscribe((response: any) => {
      if (response.success) {
        this.message = 'Inicio de sesión exitoso';
      } else {
        this.message = 'Inicio de sesión fallido';
      }
    });
  }
}
