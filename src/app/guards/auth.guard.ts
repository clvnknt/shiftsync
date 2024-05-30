import { CanActivateFn } from '@angular/router';

export const authGuard: CanActivateFn = (route, state) => {
  const user = localStorage.getItem('currentUser');
  if (user) {
    return true;
  }

  // Redirect to login page
  window.location.href = '/login';
  return false;
};