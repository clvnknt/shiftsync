import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private currentUserSubject: BehaviorSubject<any>;
  public currentUser: Observable<any>;

  constructor(private http: HttpClient) {
    const user = localStorage.getItem('currentUser');
    this.currentUserSubject = new BehaviorSubject<any>(user ? JSON.parse(user) : null);
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public get currentUserValue(): any {
    return this.currentUserSubject.value;
  }

  login(email: string, password: string): Observable<any> {
    return this.http.post<any>('http://localhost:8000/api/login', { email, password }).pipe(
      map(response => {
        if (response && response.token) {
          const user = {
            ...response.user,
            token: response.token
          };
          localStorage.setItem('currentUser', JSON.stringify(user));
          this.currentUserSubject.next(user);
        }
        return response;
      })
    );
  }

  logout(): Observable<void> {
    const currentUser = this.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return new Observable<void>(observer => {
        this.clearCurrentUser();
        observer.next();
        observer.complete();
      });
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.post<void>('http://localhost:8000/api/logout', {}, { headers }).pipe(
      map(() => {
        this.clearCurrentUser();
      })
    );
  }

  clearCurrentUser(): void {
    localStorage.removeItem('currentUser');
    this.currentUserSubject.next(null);
  }

  isAuthenticated(): boolean {
    const user = localStorage.getItem('currentUser');
    if (!user) {
      return false;
    }
    const currentUser = JSON.parse(user);
    return !!(currentUser && currentUser.token);
  }
}