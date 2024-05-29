import { Component, OnInit } from '@angular/core';
import { UserService } from '../../services/user.service';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {
  users: any[] = [];
  currentUser: any;

  constructor(
    private userService: UserService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    if (!this.authService.isAuthenticated()) {
      this.router.navigate(['/login']);
      return;
    } else {
      this.currentUser = this.authService.currentUserValue;
    }

    this.userService.getUsers().subscribe({
      next: users => this.users = users,
      error: err => {
        console.error('Failed to fetch users:', err);
        if (err.status === 401) {
          this.authService.clearCurrentUser();
          this.router.navigate(['/login']);
        }
      }
    });
  }

  addUser(): void {
    // Navigate to add user page or open a modal (not implemented here)
    this.router.navigate(['/add-user']);
  }

  viewUser(id: number): void {
    // Navigate to view user page or open a modal (not implemented here)
    this.router.navigate(['/view-user', id]);
  }

  editUser(id: number): void {
    // Navigate to edit user page or open a modal (not implemented here)
    this.router.navigate(['/edit-user', id]);
  }

  deleteUser(id: number): void {
    // Call the service to delete user
    this.userService.deleteUser(id).subscribe({
      next: () => {
        // Refresh the list after deletion
        this.users = this.users.filter(user => user.id !== id);
      },
      error: err => {
        console.error('Failed to delete user:', err);
      }
    });
  }
}