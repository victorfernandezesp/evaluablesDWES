import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EditarContactosService {
  private apiUrl = 'http://apirestcontactos.local/contactos';

  constructor(private http: HttpClient) { }

  getContacto(contactoId: number): Observable<any> {
    console.log('Tonto getContacto');
    
    const url = `${this.apiUrl}/${contactoId}`;
    console.log(url);
    console.log(contactoId);
    
    return this.http.get(url);
  }

  actualizarContacto(contactoActualizado: any): Observable<any> {
    console.log('Tonto ActualizarContacto');
    const url = `${this.apiUrl}/${contactoActualizado.id}`;
    return this.http.put(url, contactoActualizado);
  }
}