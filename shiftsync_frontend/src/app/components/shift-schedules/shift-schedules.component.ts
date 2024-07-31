import { Component, OnInit } from '@angular/core';
import { ShiftScheduleService } from '../../services/shift-schedule.service';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-shift-schedules',
  templateUrl: './shift-schedules.component.html',
  styleUrls: ['./shift-schedules.component.scss']
})
export class ShiftSchedulesComponent implements OnInit {
  shiftSchedules: any[] = [];
  currentUser: any;

  constructor(
    private shiftScheduleService: ShiftScheduleService,
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

    this.shiftScheduleService.getShiftSchedules().subscribe({
      next: shiftSchedules => this.shiftSchedules = shiftSchedules,
      error: err => {
        console.error('Failed to fetch shift schedules:', err);
        if (err.status === 401) {
          this.authService.clearCurrentUser();
          this.router.navigate(['/login']);
        }
      }
    });
  }

  addShiftSchedule(): void {
    this.router.navigate(['/add-shift-schedule']);
  }

  viewShiftSchedule(id: number): void {
    this.router.navigate(['/view-shift-schedule', id]);
  }

  editShiftSchedule(id: number): void {
    this.router.navigate(['/edit-shift-schedule', id]);
  }

  deleteShiftSchedule(id: number): void {
    this.shiftScheduleService.deleteShiftSchedule(id).subscribe({
      next: () => {
        this.shiftSchedules = this.shiftSchedules.filter(schedule => schedule.id !== id);
      },
      error: err => {
        console.error('Failed to delete shift schedule:', err);
      }
    });
  }
}