import { ComponentFixture, TestBed } from '@angular/core/testing';
import { PadresFamiliaComponent } from './padres-familia.component'; 

describe('PadresFamiliaComponent', () => {
  let component: PadresFamiliaComponent;
  let fixture: ComponentFixture<PadresFamiliaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [PadresFamiliaComponent]
    });
    fixture = TestBed.createComponent(PadresFamiliaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
