import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms'; // Import ReactiveFormsModule
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { UsersComponent } from './components/users/users.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { UserFormComponent } from './components/user-form/user-form.component';
import { UserDetailComponent } from './components/user-detail/user-detail.component';
import { DepartmentsComponent } from './components/departments/departments.component';
import { DepartmentFormComponent } from './components/department-form/department-form.component';
import { DepartmentDetailComponent } from './components/department-detail/department-detail.component';
import { RolesComponent } from './components/roles/roles.component';
import { RoleFormComponent } from './components/role-form/role-form.component';
import { RoleDetailComponent } from './components/role-detail/role-detail.component';
import { ShiftSchedulesComponent } from './components/shift-schedules/shift-schedules.component';
import { ShiftScheduleFormComponent } from './components/shift-schedule-form/shift-schedule-form.component';
import { ShiftScheduleDetailComponent } from './components/shift-schedule-detail/shift-schedule-detail.component';
import { EmployeeRecordsComponent } from './components/employee-records/employee-records.component';
import { EmployeeRecordFormComponent } from './components/employee-record-form/employee-record-form.component';
import { EmployeeRecordDetailComponent } from './components/employee-record-detail/employee-record-detail.component';
import { AppRoutingModule } from './app-routing.module';
import { EmployeeAssignedShiftListComponent } from './components/employee-assigned-shift-list/employee-assigned-shift-list.component';
import { EmployeeAssignedShiftDetailComponent } from './components/employee-assigned-shift-detail/employee-assigned-shift-detail.component';
import { EmployeeAssignedShiftFormComponent } from './components/employee-assigned-shift-form/employee-assigned-shift-form.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    DashboardComponent,
    UsersComponent,
    SidebarComponent,
    UserFormComponent,
    UserDetailComponent,
    DepartmentsComponent,
    DepartmentFormComponent,
    DepartmentDetailComponent,
    RolesComponent,
    RoleFormComponent,
    RoleDetailComponent,
    ShiftSchedulesComponent,
    ShiftScheduleFormComponent,
    ShiftScheduleDetailComponent,
    EmployeeRecordsComponent,
    EmployeeRecordFormComponent,
    EmployeeRecordDetailComponent,
    EmployeeAssignedShiftListComponent,
    EmployeeAssignedShiftDetailComponent,
    EmployeeAssignedShiftFormComponent
  ],
  imports: [
    BrowserModule,
    FormsModule, 
    ReactiveFormsModule, 
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }