import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../environments/environment';


@Injectable({
  providedIn: 'root'
})
export class CreateContactos {
  constructor(private http: HttpClient) {}

  crearContacto(contactoData: any): Observable<any> {
    const url = `${environment.baseUrl}contactos/`;
    return this.http.post(url, contactoData);
  }
}