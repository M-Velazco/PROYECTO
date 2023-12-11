import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './components/login/login.component';
import { IndexComponent } from './index/index.component';
import { ChatComponent } from './chat/chat.component';
import { PrincipalComponent } from './principal/principal.component';

const routes: Routes = [
  { path: '', component: IndexComponent },
  { path: 'Login', component: LoginComponent },
  {path:'chat',component:ChatComponent},
  {path:'principal',component: PrincipalComponent},
  { path: '', redirectTo: 'Index', pathMatch: 'full' },

   // Ruta por defecto para manejar rutas no encontradas
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
