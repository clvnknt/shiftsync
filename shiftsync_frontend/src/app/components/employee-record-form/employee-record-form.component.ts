import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { EmployeeRecordService } from '../../services/employee-record.service';
import { DepartmentService } from '../../services/department.service'; // Import DepartmentService
import { RoleService } from '../../services/role.service'; // Import RoleService

@Component({
  selector: 'app-employee-record-form',
  templateUrl: './employee-record-form.component.html',
  styleUrls: ['./employee-record-form.component.scss']
})
export class EmployeeRecordFormComponent implements OnInit {
  employeeRecord: any = {
    user_id: '',
    department_id: '',
    role_id: '',
    address_id: '',
    emergency_contact_id: '',
    employee_first_name: '',
    employee_middle_name: '',
    employee_last_name: '',
    employee_suffix: '',
    employee_gender: '',
    employee_age: '',
    employee_birthdate: '',
    employee_profile_picture: '',
    employee_timezone: '+08:00'
  };
  departments: any[] = [];
  roles: any[] = [];
  isEdit: boolean = false;

  constructor(
    private employeeRecordService: EmployeeRecordService,
    private departmentService: DepartmentService,
    private roleService: RoleService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    this.loadDepartments();
    this.loadRoles();
    if (id) {
      this.isEdit = true;
      this.employeeRecordService.getEmployeeRecord(+id).subscribe({
        next: record => this.employeeRecord = record,
        error: err => console.error('Failed to fetch employee record:', err)
      });
    }
  }

  loadDepartments(): void {
    this.departmentService.getDepartments().subscribe({
      next: departments => this.departments = departments,
      error: err => console.error('Failed to fetch departments:', err)
    });
  }

  loadRoles(): void {
    this.roleService.getRoles().subscribe({
      next: roles => this.roles = roles,
      error: err => console.error('Failed to fetch roles:', err)
    });
  }

  saveEmployeeRecord(): void {
    // Log the employeeRecord data being sent to the server
    console.log('Employee Record Data:', this.employeeRecord);
  
    if (this.isEdit) {
      this.employeeRecordService.updateEmployeeRecord(this.employeeRecord.id, this.employeeRecord).subscribe({
        next: () => this.router.navigate(['/employee-records']),
        error: err => console.error('Failed to update employee record:', err)
      });
    } else {
      this.employeeRecordService.addEmployeeRecord(this.employeeRecord).subscribe({
        next: () => this.router.navigate(['/employee-records']),
        error: err => console.error('Failed to add employee record:', err)
      });
    }
  }
}