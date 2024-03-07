import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateContactosComponent } from './add-contactos.component';

describe('CreateContactosComponent', () => {
  let component: CreateContactosComponent;
  let fixture: ComponentFixture<CreateContactosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [CreateContactosComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CreateContactosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
