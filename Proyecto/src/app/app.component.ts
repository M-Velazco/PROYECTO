import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'Proyecto';
  isLogin = true;

  toggleForm() {
    this.isLogin = !this.isLogin;
  }
}
