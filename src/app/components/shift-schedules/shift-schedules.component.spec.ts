import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ShiftSchedulesComponent } from './shift-schedules.component';

describe('ShiftSchedulesComponent', () => {
  let component: ShiftSchedulesComponent;
  let fixture: ComponentFixture<ShiftSchedulesComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ShiftSchedulesComponent]
    });
    fixture = TestBed.createComponent(ShiftSchedulesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
