import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ChatComponent } from './chat/chat.component';
import { FormComponent } from './form/form.component';
import { LoginComponent } from './login/login.component';
import { RegistrationComponent } from './registration/registration.component'; // Remove the ".ts" extension

@NgModule({
  declarations: [
    AppComponent,
    ChatComponent,
    FormComponent,
    LoginComponent,
    RegistrationComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ChatComponent,
    FormComponent
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
