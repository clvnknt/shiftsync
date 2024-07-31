import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ShiftScheduleDetailComponent } from './shift-schedule-detail.component';

describe('ShiftScheduleDetailComponent', () => {
  let component: ShiftScheduleDetailComponent;
  let fixture: ComponentFixture<ShiftScheduleDetailComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ShiftScheduleDetailComponent]
    });
    fixture = TestBed.createComponent(ShiftScheduleDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
