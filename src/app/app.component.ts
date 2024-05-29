import { Component, OnInit } from '@angular/core';
import { AuthService } from './services/auth.service';
import { Router, NavigationEnd } from '@angular/router';
import { filter } from 'rxjs/operators';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  isLoggedIn: boolean = false;
  showSidebar: boolean = true;

  constructor(private authService: AuthService, private router: Router) {
    this.router.events.pipe(
      filter((event): event is NavigationEnd => event instanceof NavigationEnd)
    ).subscribe((event: NavigationEnd) => {
      this.showSidebar = !event.url.includes('/login');
      this.isLoggedIn = this.authService.isAuthenticated();
    });
  }

  ngOnInit(): void {
    this.isLoggedIn = this.authService.isAuthenticated();
  }
}