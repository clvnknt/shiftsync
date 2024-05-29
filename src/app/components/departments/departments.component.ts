import { Component, OnInit } from '@angular/core';
import { DepartmentService } from '../../services/department.service';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-departments',
  templateUrl: './departments.component.html',
  styleUrls: ['./departments.component.scss']
})
export class DepartmentsComponent implements OnInit {
  departments: any[] = [];
  currentUser: any;

  constructor(
    private departmentService: DepartmentService,
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

    this.departmentService.getDepartments().subscribe({
      next: departments => this.departments = departments,
      error: err => {
        console.error('Failed to fetch departments:', err);
        if (err.status === 401) {
          this.authService.clearCurrentUser();
          this.router.navigate(['/login']);
        }
      }
    });
  }

  addDepartment(): void {
    this.router.navigate(['/add-department']);
  }

  viewDepartment(id: number): void {
    this.router.navigate(['/view-department', id]);
  }

  editDepartment(id: number): void {
    this.router.navigate(['/edit-department', id]);
  }

  deleteDepartment(id: number): void {
    this.departmentService.deleteDepartment(id).subscribe({
      next: () => {
        this.departments = this.departments.filter(department => department.id !== id);
      },
      error: err => {
        console.error('Failed to delete department:', err);
      }
    });
  }
}