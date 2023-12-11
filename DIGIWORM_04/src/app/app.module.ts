import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { ReactiveFormsModule } from '@angular/forms';


import {FormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import { IndexComponent } from './index/index.component';
import { ChatComponent } from './chat/chat.component';
import { PrincipalComponent } from './principal/principal.component';
import { PublicacionesComponent } from './publicaciones/publicaciones.component';
import { DocentesComponent } from './docentes/docentes.component';
import { PadresFamiliaComponent } from './padres-familia/padres-familia.component';
import { CursoComponent } from './curso/curso.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    IndexComponent,
    ChatComponent,
    PrincipalComponent,
    PublicacionesComponent,
    DocentesComponent,
    PadresFamiliaComponent,
    CursoComponent
  ],
  imports: [
    ReactiveFormsModule,
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
