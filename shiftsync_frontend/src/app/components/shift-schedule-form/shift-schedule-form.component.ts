import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ShiftScheduleService } from '../../services/shift-schedule.service';

@Component({
  selector: 'app-shift-schedule-form',
  templateUrl: './shift-schedule-form.component.html',
  styleUrls: ['./shift-schedule-form.component.scss']
})
export class ShiftScheduleFormComponent implements OnInit {
  shiftSchedule: any = { shift_name: '', start_shift_time: '', shift_start_grace_period: '', lunch_start_time: '', end_lunch_time: '', end_shift_time: '', shift_timezone: '+08:00' };
  isEdit: boolean = false;

  constructor(
    private shiftScheduleService: ShiftScheduleService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEdit = true;
      this.shiftScheduleService.getShiftSchedule(+id).subscribe({
        next: schedule => this.shiftSchedule = schedule,
        error: err => console.error('Failed to fetch shift schedule:', err)
      });
    }
  }

  saveShiftSchedule(): void {
    if (this.isEdit) {
      this.shiftScheduleService.updateShiftSchedule(this.shiftSchedule.id, this.shiftSchedule).subscribe({
        next: () => this.router.navigate(['/shift-schedules']),
        error: err => console.error('Failed to update shift schedule:', err)
      });
    } else {
      this.shiftScheduleService.addShiftSchedule(this.shiftSchedule).subscribe({
        next: () => this.router.navigate(['/shift-schedules']),
        error: err => console.error('Failed to add shift schedule:', err)
      });
    }
  }
}