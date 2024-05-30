import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { EmployeeAssignedShiftService } from '../../services/employee-assigned-shift.service';

@Component({
  selector: 'app-employee-assigned-shift-detail',
  templateUrl: './employee-assigned-shift-detail.component.html',
  styleUrls: ['./employee-assigned-shift-detail.component.css']
})
export class EmployeeAssignedShiftDetailComponent implements OnInit {
  assignedShift: any;

  constructor(
    private route: ActivatedRoute,
    private assignedShiftService: EmployeeAssignedShiftService
  ) { }

  ngOnInit(): void {
    const id = +this.route.snapshot.paramMap.get('id')!;
    this.assignedShiftService.getEmployeeAssignedShift(id).subscribe(
      (data) => this.assignedShift = data,
      (error) => console.error('Failed to fetch employee assigned shift:', error)
    );
  }
}