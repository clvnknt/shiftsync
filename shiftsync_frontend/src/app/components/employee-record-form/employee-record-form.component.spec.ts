import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmployeeRecordFormComponent } from './employee-record-form.component';

describe('EmployeeRecordFormComponent', () => {
  let component: EmployeeRecordFormComponent;
  let fixture: ComponentFixture<EmployeeRecordFormComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EmployeeRecordFormComponent]
    });
    fixture = TestBed.createComponent(EmployeeRecordFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
