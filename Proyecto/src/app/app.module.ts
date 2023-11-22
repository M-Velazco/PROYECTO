import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from '@angular/common/http';
import { AppComponent } from './app.component';
import { ChatComponent } from './chat/chat.component';
import { loginComponent } from './login/login.component';
import { IndexComponent } from './index/index.component';


@NgModule({
  declarations: [
    AppComponent,
    ChatComponent,
    loginComponent,
    IndexComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ChatComponent,
    loginComponent,
    HttpClientModule,
    IndexComponent
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
