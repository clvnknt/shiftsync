import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ShiftScheduleService } from '../../services/shift-schedule.service';

@Component({
  selector: 'app-shift-schedule-detail',
  templateUrl: './shift-schedule-detail.component.html',
  styleUrls: ['./shift-schedule-detail.component.scss']
})
export class ShiftScheduleDetailComponent implements OnInit {
  shiftSchedule: any;

  constructor(
    private shiftScheduleService: ShiftScheduleService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.shiftScheduleService.getShiftSchedule(+id).subscribe({
        next: schedule => this.shiftSchedule = schedule,
        error: err => console.error('Failed to fetch shift schedule:', err)
      });
    }
  }
}