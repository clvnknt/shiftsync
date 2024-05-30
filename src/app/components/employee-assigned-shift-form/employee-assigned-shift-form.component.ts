import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { EmployeeAssignedShiftService } from '../../services/employee-assigned-shift.service';

@Component({
  selector: 'app-employee-assigned-shift-form',
  templateUrl: './employee-assigned-shift-form.component.html',
  styleUrls: ['./employee-assigned-shift-form.component.css']
})
export class EmployeeAssignedShiftFormComponent implements OnInit {
  assignedShiftForm: FormGroup;
  isEditMode: boolean = false;
  assignedShiftId!: number;

  constructor(
    private fb: FormBuilder,
    private assignedShiftService: EmployeeAssignedShiftService,
    private route: ActivatedRoute,
    private router: Router
  ) {
    this.assignedShiftForm = this.fb.group({
      employee_record_id: ['', Validators.required],
      shift_schedule_id: ['', Validators.required],
      is_active: [false]
    });
  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      if (params['id']) {
        this.isEditMode = true;
        this.assignedShiftId = +params['id'];
        this.assignedShiftService.getEmployeeAssignedShift(this.assignedShiftId).subscribe(
          (data) => this.assignedShiftForm.patchValue(data),
          (error) => console.error('Failed to fetch employee assigned shift:', error)
        );
      }
    });
  }

  onSubmit(): void {
    if (this.assignedShiftForm.valid) {
      if (this.isEditMode) {
        this.assignedShiftService.updateEmployeeAssignedShift(this.assignedShiftId, this.assignedShiftForm.value).subscribe(
          () => this.router.navigate(['/assigned-shifts']),
          (error) => console.error('Failed to update employee assigned shift:', error)
        );
      } else {
        this.assignedShiftService.addEmployeeAssignedShift(this.assignedShiftForm.value).subscribe(
          () => this.router.navigate(['/assigned-shifts']),
          (error) => console.error('Failed to add employee assigned shift:', error)
        );
      }
    }
  }
}