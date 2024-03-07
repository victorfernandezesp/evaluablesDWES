import { Component } from '@angular/core';
import { CreateContactos } from '../create-contactos.service';
@Component({
  selector: 'app-add-contactos',
  templateUrl: './add-contactos.component.html',
  styleUrls: ['./add-contactos.component.css']
})
export class CreateContactosComponent  {
  contactoData: any = {};

  constructor(private contacto: CreateContactos) { }

  onSubmit() {
    console.log(this.contactoData);
    // Llamada al servicio para enviar los datos al servidor
    this.contacto.crearContacto(this.contactoData).subscribe(
      response => {
        console.log('Contacto creado con éxito:', response);
        window.location.reload();
      },
      error => {
        console.error('Error al crear el contacto:', error);
      }
    );
  }
}
