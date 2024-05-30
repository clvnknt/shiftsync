import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmployeeRecordDetailComponent } from './employee-record-detail.component';

describe('EmployeeRecordDetailComponent', () => {
  let component: EmployeeRecordDetailComponent;
  let fixture: ComponentFixture<EmployeeRecordDetailComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EmployeeRecordDetailComponent]
    });
    fixture = TestBed.createComponent(EmployeeRecordDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
