import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Padres_FamiliaComponent } from './padres_familia.component';

describe('PadresFamiliaComponent', () => {
  let component: Padres_FamiliaComponent;
  let fixture: ComponentFixture<Padres_FamiliaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [Padres_FamiliaComponent]
    });
    fixture = TestBed.createComponent(Padres_FamiliaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
