import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmployeeAssignedShiftDetailComponent } from './employee-assigned-shift-detail.component';

describe('EmployeeAssignedShiftDetailComponent', () => {
  let component: EmployeeAssignedShiftDetailComponent;
  let fixture: ComponentFixture<EmployeeAssignedShiftDetailComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EmployeeAssignedShiftDetailComponent]
    });
    fixture = TestBed.createComponent(EmployeeAssignedShiftDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
