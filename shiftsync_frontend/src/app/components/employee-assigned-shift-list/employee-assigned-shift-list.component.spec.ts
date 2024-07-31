import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmployeeAssignedShiftListComponent } from './employee-assigned-shift-list.component';

describe('EmployeeAssignedShiftListComponent', () => {
  let component: EmployeeAssignedShiftListComponent;
  let fixture: ComponentFixture<EmployeeAssignedShiftListComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EmployeeAssignedShiftListComponent]
    });
    fixture = TestBed.createComponent(EmployeeAssignedShiftListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
