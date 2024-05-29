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
      map(user => {
        if (user && user.token) {
          localStorage.setItem('currentUser', JSON.stringify(user));
          this.currentUserSubject.next(user);
        }
        return user;
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

  getCurrentUser(): Observable<any> {
    const currentUser = this.currentUserValue;
    if (!currentUser || !currentUser.token) {
      return new Observable<any>(observer => {
        observer.next(null);
        observer.complete();
      });
    }
    const headers = new HttpHeaders().set('Authorization', `Bearer ${currentUser.token}`);
    return this.http.get<any>('http://localhost:8000/api/user', { headers }).pipe(
      map(user => {
        this.currentUserSubject.next(user);
        return user;
      })
    );
  }

  clearCurrentUser(): void {
    localStorage.removeItem('currentUser');
    this.currentUserSubject.next(null);
    console.log('Cleared current user');
  }

  isAuthenticated(): boolean {
    const currentUser = this.currentUserValue;
    return !!(currentUser && currentUser.token);
  }
}