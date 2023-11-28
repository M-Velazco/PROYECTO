import { TestBed } from '@angular/core/testing';
import { AuthService } from './auth.service';

describe('AuthService', () => {
  let service: AuthService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AuthService], 
    });
    service = TestBed.inject(AuthService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('should have a login method', () => {
    expect(service.login).toBeDefined();
    expect(typeof service.login).toBe('function');
  });

  it('should have a logout method', () => {
    expect(service.logout).toBeDefined();
    expect(typeof service.logout).toBe('function');
  });

  
});
