import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class EmployeeAssignedShiftService {
  private apiUrl = 'http://localhost:8000/api/employee-assigned-shifts';

  constructor(private http: HttpClient, private authService: AuthService) { }

  private getAuthHeaders(): HttpHeaders {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      throw new Error('User is not logged in');
    }
    return new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
  }

  getEmployeeAssignedShifts(): Observable<any[]> {
    const headers = this.getAuthHeaders();
    return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch employee assigned shifts:', err);
        return throwError(err);
      })
    );
  }

  getEmployeeAssignedShift(id: number): Observable<any> {
    const headers = this.getAuthHeaders();
    return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch employee assigned shift:', err);
        return throwError(err);
      })
    );
  }

  addEmployeeAssignedShift(assignedShift: any): Observable<any> {
    const headers = this.getAuthHeaders();
    return this.http.post<any>(this.apiUrl, assignedShift, { headers }).pipe(
      catchError(err => {
        console.error('Failed to add employee assigned shift:', err);
        return throwError(err);
      })
    );
  }

  updateEmployeeAssignedShift(id: number, assignedShift: any): Observable<any> {
    const headers = this.getAuthHeaders();
    return this.http.put<any>(`${this.apiUrl}/${id}`, assignedShift, { headers }).pipe(
      catchError(err => {
        console.error('Failed to update employee assigned shift:', err);
        return throwError(err);
      })
    );
  }

  deleteEmployeeAssignedShift(id: number): Observable<void> {
    const headers = this.getAuthHeaders();
    return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to delete employee assigned shift:', err);
        return throwError(err);
      })
    );
  }
}