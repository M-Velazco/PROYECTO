import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './components/login/login.component';
import { IndexComponent } from './index/index.component';
import { ChatComponent } from './chat/chat.component';
import { PrincipalComponent } from './principal/principal.component';
import { PublicacionesComponent } from './publicaciones/publicaciones.component';
import { DocentesComponent } from './docentes/docentes.component';
import { CursoComponent } from './curso/curso.component';
import {AppComponents} from './Materias/src/app/app.component';

const routes: Routes = [
  { path: 'Index', component: IndexComponent },
  { path: 'Login', component: LoginComponent },
  { path: 'docentes', component: DocentesComponent },
  {path:'chat',component:ChatComponent},
  {path:'principal',component: PrincipalComponent},
  {path:'Publicaciones',component: PublicacionesComponent},
  { path: 'curso', component: CursoComponent },
  { path: 'Materias', component: AppComponents },
  { path: '', redirectTo: 'Index', pathMatch: 'full' },

   // Ruta por defecto para manejar rutas no encontradas
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
