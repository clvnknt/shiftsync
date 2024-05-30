import { Component, OnInit } from '@angular/core';
import { EmployeeAssignedShiftService } from '../../services/employee-assigned-shift.service';

@Component({
  selector: 'app-employee-assigned-shift-list',
  templateUrl: './employee-assigned-shift-list.component.html',
  styleUrls: ['./employee-assigned-shift-list.component.scss']
})
export class EmployeeAssignedShiftListComponent implements OnInit {
  assignedShifts: any[] = [];

  constructor(private assignedShiftService: EmployeeAssignedShiftService) { }

  ngOnInit(): void {
    this.assignedShiftService.getEmployeeAssignedShifts().subscribe(
      (data) => {
        this.assignedShifts = data;
        console.log('Fetched employee assigned shifts:', this.assignedShifts); // Log the fetched data
      },
      (error) => {
        console.error('Failed to fetch employee assigned shifts:', error);
      }
    );
  }

  deleteShift(id: number): void {
    console.log('Deleting shift with id:', id); // Log the id of the shift to be deleted
    this.assignedShiftService.deleteEmployeeAssignedShift(id).subscribe(
      () => {
        this.assignedShifts = this.assignedShifts.filter(shift => shift.id !== id);
        console.log('Updated assigned shifts after deletion:', this.assignedShifts); // Log the updated list
      },
      (error) => {
        console.error('Failed to delete assigned shift:', error);
      }
    );
  }
}