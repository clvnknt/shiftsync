import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class RoleService {
  private apiUrl = 'http://localhost:8000/api/roles';

  constructor(private http: HttpClient, private authService: AuthService) { }

  getRoles(): Observable<any[]> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch roles:', err);
        return throwError(err);
      })
    );
  }

  getRole(id: number): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch role:', err);
        return throwError(err);
      })
    );
  }

  addRole(role: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.post<any>(this.apiUrl, role, { headers }).pipe(
      catchError(err => {
        console.error('Failed to add role:', err);
        return throwError(err);
      })
    );
  }

  updateRole(id: number, role: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.put<any>(`${this.apiUrl}/${id}`, role, { headers }).pipe(
      catchError(err => {
        console.error('Failed to update role:', err);
        return throwError(err);
      })
    );
  }

  deleteRole(id: number): Observable<void> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to delete role:', err);
        return throwError(err);
      })
    );
  }
}