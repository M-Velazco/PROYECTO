import { LoginComponent } from './../components/login/login.component';
import { Component } from '@angular/core';
import { LoginService } from '../login.service';

@Component({
  selector: 'app-chat',
  templateUrl: './chat.component.html',
  styleUrls: ['./chat.component.css',]
})
export class ChatComponent {
title='chat'
email: string = '';
password: string = '';

  onSubmit() {
    // Add your login logic here
    // You can use services to handle authentication
  }

}
