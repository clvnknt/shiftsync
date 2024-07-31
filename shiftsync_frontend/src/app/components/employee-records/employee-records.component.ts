import { Component, OnInit } from '@angular/core';
import { EmployeeRecordService } from '../../services/employee-record.service';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-employee-records',
  templateUrl: './employee-records.component.html',
  styleUrls: ['./employee-records.component.scss']
})
export class EmployeeRecordsComponent implements OnInit {
  employeeRecords: any[] = [];
  currentUser: any;

  constructor(
    private employeeRecordService: EmployeeRecordService,
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

    this.employeeRecordService.getEmployeeRecords().subscribe({
      next: employeeRecords => this.employeeRecords = employeeRecords,
      error: err => {
        console.error('Failed to fetch employee records:', err);
        if (err.status === 401) {
          this.authService.clearCurrentUser();
          this.router.navigate(['/login']);
        }
      }
    });
  }

  addEmployeeRecord(): void {
    this.router.navigate(['/add-employee-record']);
  }

  viewEmployeeRecord(id: number): void {
    this.router.navigate(['/view-employee-record', id]);
  }

  editEmployeeRecord(id: number): void {
    this.router.navigate(['/edit-employee-record', id]);
  }

  deleteEmployeeRecord(id: number): void {
    this.employeeRecordService.deleteEmployeeRecord(id).subscribe({
      next: () => {
        this.employeeRecords = this.employeeRecords.filter(record => record.id !== id);
      },
      error: err => {
        console.error('Failed to delete employee record:', err);
      }
    });
  }
}