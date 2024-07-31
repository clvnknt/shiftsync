import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from './services/auth.service';

// Marks the class as available to be provided and injected as a dependency
@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  // Injects the AuthService into the interceptor
  constructor(private authService: AuthService) {}

  // Method that intercepts HTTP requests
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    // Retrieves the current user and their token from the AuthService
    const currentUser = this.authService.currentUserValue;
    
    // If a current user and token exist, clone the request and add the Authorization header
    if (currentUser && currentUser.token) {
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${currentUser.token}` // Sets the Authorization header with the user's token
        }
      });
    }

    // Passes the (potentially modified) request to the next handler in the chain
    return next.handle(request);
  }
}