import { TestBed } from '@angular/core/testing';

import { CreateContactos } from './create-contactos.service';

describe('CreateContactosService', () => {
  let service: CreateContactos;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CreateContactos);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});