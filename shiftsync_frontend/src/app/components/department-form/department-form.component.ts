import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { DepartmentService } from '../../services/department.service';

@Component({
  selector: 'app-department-form',
  templateUrl: './department-form.component.html',
  styleUrls: ['./department-form.component.scss']
})
export class DepartmentFormComponent implements OnInit {
  department: any = { department_name: '', department_description: '' };
  isEdit: boolean = false;

  constructor(
    private departmentService: DepartmentService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEdit = true;
      this.departmentService.getDepartment(+id).subscribe({
        next: department => this.department = department,
        error: err => console.error('Failed to fetch department:', err)
      });
    }
  }

  saveDepartment(): void {
    if (this.isEdit) {
      this.departmentService.updateDepartment(this.department.id, this.department).subscribe({
        next: () => this.router.navigate(['/departments']),
        error: err => console.error('Failed to update department:', err)
      });
    } else {
      this.departmentService.addDepartment(this.department).subscribe({
        next: () => this.router.navigate(['/departments']),
        error: err => console.error('Failed to add department:', err)
      });
    }
  }
}