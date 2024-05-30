import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { RoleService } from '../../services/role.service';
import { DepartmentService } from '../../services/department.service'; // Import DepartmentService

@Component({
  selector: 'app-role-form',
  templateUrl: './role-form.component.html',
  styleUrls: ['./role-form.component.scss']
})
export class RoleFormComponent implements OnInit {
  role: any = { department_id: '', role_name: '', role_description: '' };
  departments: any[] = []; // Array to store departments
  isEdit: boolean = false;

  constructor(
    private roleService: RoleService,
    private departmentService: DepartmentService, // Inject DepartmentService
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    this.loadDepartments(); // Load departments on init
    if (id) {
      this.isEdit = true;
      this.roleService.getRole(+id).subscribe({
        next: role => this.role = role,
        error: err => console.error('Failed to fetch role:', err)
      });
    }
  }

  loadDepartments(): void {
    this.departmentService.getDepartments().subscribe({
      next: departments => this.departments = departments,
      error: err => console.error('Failed to fetch departments:', err)
    });
  }

  saveRole(): void {
    if (this.isEdit) {
      this.roleService.updateRole(this.role.id, this.role).subscribe({
        next: () => this.router.navigate(['/roles']),
        error: err => console.error('Failed to update role:', err)
      });
    } else {
      this.roleService.addRole(this.role).subscribe({
        next: () => this.router.navigate(['/roles']),
        error: err => console.error('Failed to add role:', err)
      });
    }
  }
}