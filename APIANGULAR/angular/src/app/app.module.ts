import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ListarContactosComponent } from './listar-contactos/listar-contactos.component';
import { HttpErrorHandler } from './http-error-handler.service';
import { ContactosService } from './contactos.service';
import { HttpClientModule } from '@angular/common/http';
import { CreateContactosComponent } from './add-contactos/add-contactos.component'
import { FormsModule } from '@angular/forms';
import { EditarContactoComponent } from './editar-contacto/editar-contacto.component';



@NgModule({
  declarations: [
    AppComponent,
    ListarContactosComponent,
    CreateContactosComponent,
    EditarContactoComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    provideClientHydration(),
    HttpErrorHandler,
    ContactosService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
