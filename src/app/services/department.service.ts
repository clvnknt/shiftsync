import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {
  private apiUrl = 'http://localhost:8000/api/departments';

  constructor(private http: HttpClient, private authService: AuthService) {}

  getDepartments(): Observable<any[]> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch departments:', err);
        return throwError(err);
      })
    );
  }

  getDepartment(id: number): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch department:', err);
        return throwError(err);
      })
    );
  }

  addDepartment(department: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.post<any>(this.apiUrl, department, { headers }).pipe(
      catchError(err => {
        console.error('Failed to add department:', err);
        return throwError(err);
      })
    );
  }

  updateDepartment(id: number, department: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.put<any>(`${this.apiUrl}/${id}`, department, { headers }).pipe(
      catchError(err => {
        console.error('Failed to update department:', err);
        return throwError(err);
      })
    );
  }

  deleteDepartment(id: number): Observable<void> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to delete department:', err);
        return throwError(err);
      })
    );
  }
}