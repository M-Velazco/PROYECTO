import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { AppComponents } from './app.component';

import {HttpClientModule} from '@angular/common/http';

@NgModule({
  declarations: [
    AppComponents
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponents]
})
export class AppModule { }
