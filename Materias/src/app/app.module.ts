import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CrudComponent } from './crud/crud.component';
import { CommonModule, LocationStrategy, HashLocationStrategy } from '@angular/common';
import { AgregarComponent } from './agregar/agregar.component';
import { FormsModule } from '@angular/forms';





@NgModule({
  declarations: [
    AppComponent,
    CrudComponent,
    AgregarComponent
  ],
  imports: [
    BrowserModule,
    FormsModule, 
    AppRoutingModule,
    CommonModule,
    HttpClientModule,
  ],
  providers: [{ provide: LocationStrategy, useClass: HashLocationStrategy }],
  bootstrap: [AppComponent],
})
export class AppModule { }