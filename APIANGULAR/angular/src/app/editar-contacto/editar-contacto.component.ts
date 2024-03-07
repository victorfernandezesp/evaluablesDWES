import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { EditarContactosService } from '../editar-contacto.service';
import { Router } from '@angular/router'; // Añadir la importación de Router


@Component({
  selector: 'app-editar-contacto',
  templateUrl: './editar-contacto.component.html',
  styleUrls: ['./editar-contacto.component.css']
})
export class EditarContactoComponent implements OnInit {
  contactoId!: number;  // <-- inicialización con "!"
  nombre: string = '';
  telefono: string = '';
  email: string = '';

  constructor(
    private route: ActivatedRoute,
    private editarContactosService: EditarContactosService,
    private router: Router // Inyectar el servicio Router

  ) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      console.log("Eres demasiado tonto victor");
      
      this.contactoId = +params['id'];
      console.log(this.contactoId);
      
      this.editarContactosService.getContacto(this.contactoId).subscribe(
        (contacto: any) => {
          this.nombre = contacto.nombre;
          this.telefono = contacto.telefono;
          this.email = contacto.email;
        },
        error => {
          console.error('Error al obtener detalles del contacto', error);
        }
      );
    });
  }
  guardarCambios(): void {
    // Crear un objeto con los datos actualizados del contacto
    const contactoActualizado = {
      id: this.contactoId,
      nombre: this.nombre,
      telefono: this.telefono,
      email: this.email
    };

    // Llamar al servicio para realizar la actualización (PUT) del contacto
    this.editarContactosService.actualizarContacto(contactoActualizado).subscribe(
      () => {
        
        console.log('Contacto actualizado con éxito');
        window.location.reload();

      },
      error => {
        console.error('Error al actualizar el contacto', error);
      }
    );
  }
}