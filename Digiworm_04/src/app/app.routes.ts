import { Routes } from '@angular/router';
import path from 'path';
import { RegistroComponent } from './components/registro/registro.component';
import { LoginComponent } from './components/login/login.component';

export const routes: Routes = [
    {path:'registro',component:RegistroComponent},
    {path:'login',component:LoginComponent},
    {path:'',pathMatch:'full',redirectTo:'registro'},
    {path:'**',pathMatch:'full',redirectTo:'registro'},
];
