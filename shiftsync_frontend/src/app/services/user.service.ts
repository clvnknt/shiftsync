import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'http://localhost:8000/api/users'; // Adjust as needed

  constructor(private http: HttpClient, private authService: AuthService) {}

  getUsers(): Observable<any[]> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch users:', err);
        return throwError(err);
      })
    );
  }

  deleteUser(id: number): Observable<void> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to delete user:', err);
        return throwError(err);
      })
    );
  }

  // Implement CRUD methods for add, read, update

  getUser(id: number): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch user:', err);
        return throwError(err);
      })
    );
  }

  addUser(user: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.post<any>(this.apiUrl, user, { headers }).pipe(
      catchError(err => {
        console.error('Failed to add user:', err);
        return throwError(err);
      })
    );
  }

  updateUser(id: number, user: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.put<any>(`${this.apiUrl}/${id}`, user, { headers }).pipe(
      catchError(err => {
        console.error('Failed to update user:', err);
        return throwError(err);
      })
    );
  }
}