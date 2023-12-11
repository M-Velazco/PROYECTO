import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './components/login/login.component';
import { IndexComponent } from './index/index.component';
import { ChatComponent } from './chat/chat.component';

const routes: Routes = [
  { path: 'Index', component: IndexComponent },
  { path: 'Login', component: LoginComponent },
  {path:'chat',component:ChatComponent},
  { path: '', redirectTo: 'Index', pathMatch: 'full' },

   // Ruta por defecto para manejar rutas no encontradas
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
