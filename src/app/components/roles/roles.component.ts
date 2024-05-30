import { Component, OnInit } from '@angular/core';
import { RoleService } from '../../services/role.service';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-roles',
  templateUrl: './roles.component.html',
  styleUrls: ['./roles.component.scss']
})
export class RolesComponent implements OnInit {
  roles: any[] = [];
  currentUser: any;

  constructor(
    private roleService: RoleService,
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

    this.roleService.getRoles().subscribe({
      next: roles => this.roles = roles,
      error: err => {
        console.error('Failed to fetch roles:', err);
        if (err.status === 401) {
          this.authService.clearCurrentUser();
          this.router.navigate(['/login']);
        }
      }
    });
  }

  addRole(): void {
    this.router.navigate(['/add-role']);
  }

  viewRole(id: number): void {
    this.router.navigate(['/view-role', id]);
  }

  editRole(id: number): void {
    this.router.navigate(['/edit-role', id]);
  }

  deleteRole(id: number): void {
    this.roleService.deleteRole(id).subscribe({
      next: () => {
        this.roles = this.roles.filter(role => role.id !== id);
      },
      error: err => {
        console.error('Failed to delete role:', err);
      }
    });
  }
}