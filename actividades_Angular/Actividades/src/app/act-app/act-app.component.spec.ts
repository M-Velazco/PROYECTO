import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ActAppComponent } from './act-app.component';

describe('ActAppComponent', () => {
  let component: ActAppComponent;
  let fixture: ComponentFixture<ActAppComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ActAppComponent]
    });
    fixture = TestBed.createComponent(ActAppComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
