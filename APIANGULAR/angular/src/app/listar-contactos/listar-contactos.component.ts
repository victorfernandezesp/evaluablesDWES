import { Component, OnInit } from '@angular/core';
import { ContactosService } from '../contactos.service';
import { Contactos } from '../model/contactos';
import { Router } from '@angular/router';

@Component({
  selector: 'app-listar-contactos',
  templateUrl: './listar-contactos.component.html',
  styleUrls: ['./listar-contactos.component.css']
})
export class ListarContactosComponent implements OnInit {
  contactos: any;

  constructor(private contactosService: ContactosService, private router: Router) { }

  ngOnInit(): void {
    this.getContactos();
  }

  getContactos(): void {
    this.contactosService.getContactos().subscribe(
      (result: any) => {
        this.contactos = result;
        console.log(this.contactos);
      }
    );
  }

  eliminarContacto(contactoId: number): void {
    this.contactosService.eliminarContacto(contactoId).subscribe(
      () => {
        console.log('Contacto eliminado con éxito');
        this.getContactos();
      },
      (error: any) => {
        console.error('Error al eliminar contacto', error);
      }
    );
  }

  editarContacto(contactoId: number): void {
    console.log("TONTO editarCOntacto ListarCOntacto");
    
    this.router.navigate(['/editar', contactoId]);
  }
}
