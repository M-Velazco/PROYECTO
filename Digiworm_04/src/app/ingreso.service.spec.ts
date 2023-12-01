import { TestBed } from '@angular/core/testing';

import { ingresoService } from './ingreso.service';

describe('IngresoService', () => {
  let service: ingresoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ingresoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});