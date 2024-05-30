import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmployeeAssignedShiftFormComponent } from './employee-assigned-shift-form.component';

describe('EmployeeAssignedShiftFormComponent', () => {
  let component: EmployeeAssignedShiftFormComponent;
  let fixture: ComponentFixture<EmployeeAssignedShiftFormComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EmployeeAssignedShiftFormComponent]
    });
    fixture = TestBed.createComponent(EmployeeAssignedShiftFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
