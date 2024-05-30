import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class ShiftScheduleService {
  private apiUrl = 'http://localhost:8000/api/shift-schedules';

  constructor(private http: HttpClient, private authService: AuthService) { }

  getShiftSchedules(): Observable<any[]> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any[]>(this.apiUrl, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch shift schedules:', err);
        return throwError(err);
      })
    );
  }

  getShiftSchedule(id: number): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to fetch shift schedule:', err);
        return throwError(err);
      })
    );
  }

  addShiftSchedule(shiftSchedule: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.post<any>(this.apiUrl, shiftSchedule, { headers }).pipe(
      catchError(err => {
        console.error('Failed to add shift schedule:', err);
        return throwError(err);
      })
    );
  }

  updateShiftSchedule(id: number, shiftSchedule: any): Observable<any> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.put<any>(`${this.apiUrl}/${id}`, shiftSchedule, { headers }).pipe(
      catchError(err => {
        console.error('Failed to update shift schedule:', err);
        return throwError(err);
      })
    );
  }

  deleteShiftSchedule(id: number): Observable<void> {
    const currentUser = this.authService.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return throwError(() => new Error('User is not logged in'));
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.delete<void>(`${this.apiUrl}/${id}`, { headers }).pipe(
      catchError(err => {
        console.error('Failed to delete shift schedule:', err);
        return throwError(err);
      })
    );
  }
}