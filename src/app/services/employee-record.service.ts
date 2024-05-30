import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class EmployeeRecordService {
  private apiUrl = 'http://localhost:8000/api/employee-records';

  constructor(private http: HttpClient, private authService: AuthService) { }

  private getAuthHeaders(): HttpHeaders {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      throw new Error('User is not logged in');
    }
    return new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
  }

  getEmployeeRecords(): Observable<any[]> {
    try {
      const headers = this.getAuthHeaders();
      return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
        catchError(err => {
          console.error('Failed to fetch employee records:', err);
          return throwError(err);
        })
      );
    } catch (error) {
      return throwError(() => error);
    }
  }

  getEmployeeRecord(id: number): Observable<any> {
    try {
      const headers = this.getAuthHeaders();
      return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
        catchError(err => {
          console.error('Failed to fetch employee record:', err);
          return throwError(err);
        })
      );
    } catch (error) {
      return throwError(() => error);
    }
  }

  addEmployeeRecord(employeeRecord: any): Observable<any> {
    try {
      const headers = this.getAuthHeaders();
      return this.http.post<any>(this.apiUrl, employeeRecord, { headers }).pipe(
        catchError(err => {
          console.error('Failed to add employee record:', err);
          return throwError(err);
        })
      );
    } catch (error) {
      return throwError(() => error);
    }
  }

  updateEmployeeRecord(id: number, employeeRecord: any): Observable<any> {
    try {
      const headers = this.getAuthHeaders();
      return this.http.put<any>(`${this.apiUrl}/${id}`, employeeRecord, { headers }).pipe(
        catchError(err => {
          console.error('Failed to update employee record:', err);
          return throwError(err);
        })
      );
    } catch (error) {
      return throwError(() => error);
    }
  }

  deleteEmployeeRecord(id: number): Observable<void> {
    try {
      const headers = this.getAuthHeaders();
      return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
        catchError(err => {
          console.error('Failed to delete employee record:', err);
          return throwError(err);
        })
      );
    } catch (error) {
      return throwError(() => error);
    }
  }
}