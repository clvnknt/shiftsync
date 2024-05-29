import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  email: string = '';
  password: string = '';
  loading: boolean = false;

  constructor(private authService: AuthService, private router: Router) {}

  login() {
    this.loading = true;
    this.authService.login(this.email, this.password).subscribe(
      data => {
        this.router.navigate(['/dashboard']);
      },
      error => {
        this.loading = false;
        alert('Login failed!');
      }
    );
  }
}