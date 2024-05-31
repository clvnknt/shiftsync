import { CanActivateFn } from '@angular/router';

// Definition of the authGuard function which implements the CanActivateFn interface
export const authGuard: CanActivateFn = (route, state) => {
  // Retrieve the 'currentUser' item from localStorage
  const user = localStorage.getItem('currentUser');
  
  // If a user is found in localStorage, allow access to the route by returning true
  if (user) {
    return true;
  }

  // If no user is found, redirect to the login page by setting the window location
  window.location.href = '/login';
  
  // Return false to prevent access to the route
  return false;
};