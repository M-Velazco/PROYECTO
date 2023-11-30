import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from '../app.component';
import { NavbarComponent } from '../components/shared/navbar/navbar.component';
import { RegistroComponent } from '../components/registro/registro.component';
import { LoginComponent } from '../components/login/login.component';
import {FormsModule} from '@angular/forms';
@NgModule({
    declarations: [
    AppComponent,
    NavbarComponent,
    RegistroComponent,
    LoginComponent
    ],
    imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule
    ],
    providers: [],
    bootstrap: [AppComponent]
    })
    export class AppModule { }