// app-routing.module.ts

import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
// import { ListarContactosComponent } from './listar-contactos/listar-contactos.component';
import { EditarContactoComponent } from './editar-contacto/editar-contacto.component';

const routes: Routes = [
  { path: '', redirectTo: '/contactos', pathMatch: 'full' },
  // { path: 'contactos', component: ListarContactosComponent },
  { path: 'editar/:id', component: EditarContactoComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
