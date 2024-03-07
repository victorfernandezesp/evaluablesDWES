import { TestBed } from '@angular/core/testing';

import { EditarContactosService } from './editar-contacto.service';

describe('EditarContactoService', () => {
  let service: EditarContactosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EditarContactosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
