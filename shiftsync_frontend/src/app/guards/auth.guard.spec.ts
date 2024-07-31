import { TestBed } from '@angular/core/testing';
import { CanActivateFn } from '@angular/router';
import { authGuard } from './auth.guard';

describe('authGuard', () => {
  const executeGuard: CanActivateFn = (...guardParameters) => 
      TestBed.runInInjectionContext(() => authGuard(...guardParameters));

  beforeEach(() => {
    TestBed.configureTestingModule({});
  });

  it('should be created', () => {
    expect(executeGuard).toBeTruthy();
  });

  it('should return true if user is authenticated', () => {
    spyOn(localStorage, 'getItem').and.returnValue(JSON.stringify({ token: 'token' }));
    expect(executeGuard({} as any, {} as any)).toBeTruthy();
  });

  it('should return false and redirect to login if user is not authenticated', () => {
    spyOn(localStorage, 'getItem').and.returnValue(null);
    spyOn(window.location, 'assign');
    expect(executeGuard({} as any, {} as any)).toBeFalsy();
    expect(window.location.assign).toHaveBeenCalledWith('/login');
  });
});