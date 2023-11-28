import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { RegistroComponent } from '../app/registro/registro.component'; // Reemplaza con la ubicación real de tu componente de inicio de sesión
import { LoginComponent } from '../app/login/login.component'; // Reemplaza con la ubicación real de tu componente principal

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'registro', component: RegistroComponent },
  { path: '', redirectTo: '/registro', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
