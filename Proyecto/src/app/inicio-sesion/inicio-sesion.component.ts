import { Component, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-inicio-sesion',
  templateUrl: './inicio-sesion.component.html',
  styleUrls: ['./inicio-sesion.component.css']
})
export class InicioSesionComponent {

}

@NgModule({
  declarations: [InicioSesionComponent],
  imports: [CommonModule],
})
export class InicioSesionModule { }
