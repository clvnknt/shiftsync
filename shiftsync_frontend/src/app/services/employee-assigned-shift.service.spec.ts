import { TestBed } from '@angular/core/testing';

import { EmployeeAssignedShiftService } from './employee-assigned-shift.service';

describe('EmployeeAssignedShiftService', () => {
  let service: EmployeeAssignedShiftService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EmployeeAssignedShiftService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
