import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { environment } from '../environments/environment';
import { HttpErrorHandler, HandleError } from './http-error-handler.service';
import { Contactos } from './model/contactos';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
    Authorization: 'my-auth-token'
  })
};

@Injectable({
  providedIn: 'root'
})
export class ContactosService {
  baseUrl = environment.baseUrl;
  private handleError: HandleError;

  constructor(
    private http: HttpClient,
    httpErrorHandler: HttpErrorHandler) {
    this.handleError = httpErrorHandler.createHandleError('ContactosService');
  }
  getContactos(): Observable<Contactos[]> {
    return this.http.get<Contactos[]>(`${this.baseUrl}contactos/`)
      .pipe(
        catchError(this.handleError('getContactos', []))
      );
  }

  getContactoPorId(id: number): Observable<Contactos> {
    return this.http.get<Contactos>(`${this.baseUrl}contactos/${id}`);
  }


  eliminarContacto(id: number): Observable<void> {
    const url = `${this.baseUrl}contactos/${id}`;
    return this.http.delete<void>(url, httpOptions)
      .pipe(
        catchError((error: any) => {
          console.error('Error al eliminar contacto', error);
          return throwError('Hubo un error al eliminar el contacto'); // Update the error message as needed
        })
      );
  }

}