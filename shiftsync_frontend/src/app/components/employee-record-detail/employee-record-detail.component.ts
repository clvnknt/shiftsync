import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { EmployeeRecordService } from '../../services/employee-record.service';

@Component({
  selector: 'app-employee-record-detail',
  templateUrl: './employee-record-detail.component.html',
  styleUrls: ['./employee-record-detail.component.scss']
})
export class EmployeeRecordDetailComponent implements OnInit {
  employeeRecord: any;

  constructor(
    private employeeRecordService: EmployeeRecordService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.employeeRecordService.getEmployeeRecord(+id).subscribe({
        next: record => this.employeeRecord = record,
        error: err => console.error('Failed to fetch employee record:', err)
      });
    }
  }
}