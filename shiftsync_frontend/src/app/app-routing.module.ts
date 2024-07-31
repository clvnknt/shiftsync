import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { UsersComponent } from './components/users/users.component';
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
import { EmployeeAssignedShiftListComponent } from './components/employee-assigned-shift-list/employee-assigned-shift-list.component';
import { EmployeeAssignedShiftDetailComponent } from './components/employee-assigned-shift-detail/employee-assigned-shift-detail.component';
import { EmployeeAssignedShiftFormComponent } from './components/employee-assigned-shift-form/employee-assigned-shift-form.component';
import { authGuard } from './guards/auth.guard';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent, canActivate: [authGuard] }, // Protect Dashboard

  // Users
  { path: 'users', component: UsersComponent, canActivate: [authGuard] },
  { path: 'add-user', component: UserFormComponent, canActivate: [authGuard] },
  { path: 'view-user/:id', component: UserDetailComponent, canActivate: [authGuard] },
  { path: 'edit-user/:id', component: UserFormComponent, canActivate: [authGuard] },

  // Departments
  { path: 'departments', component: DepartmentsComponent, canActivate: [authGuard] },
  { path: 'add-department', component: DepartmentFormComponent, canActivate: [authGuard] },
  { path: 'view-department/:id', component: DepartmentDetailComponent, canActivate: [authGuard] },
  { path: 'edit-department/:id', component: DepartmentFormComponent, canActivate: [authGuard] },

  // Roles
  { path: 'roles', component: RolesComponent, canActivate: [authGuard] },
  { path: 'add-role', component: RoleFormComponent, canActivate: [authGuard] },
  { path: 'view-role/:id', component: RoleDetailComponent, canActivate: [authGuard] },
  { path: 'edit-role/:id', component: RoleFormComponent, canActivate: [authGuard] },

  // Shift Schedules
  { path: 'shift-schedules', component: ShiftSchedulesComponent, canActivate: [authGuard] },
  { path: 'add-shift-schedule', component: ShiftScheduleFormComponent, canActivate: [authGuard] },
  { path: 'view-shift-schedule/:id', component: ShiftScheduleDetailComponent, canActivate: [authGuard] },
  { path: 'edit-shift-schedule/:id', component: ShiftScheduleFormComponent, canActivate: [authGuard] },

  // Employee Records
  { path: 'employee-records', component: EmployeeRecordsComponent, canActivate: [authGuard] },
  { path: 'add-employee-record', component: EmployeeRecordFormComponent, canActivate: [authGuard] },
  { path: 'view-employee-record/:id', component: EmployeeRecordDetailComponent, canActivate: [authGuard] },
  { path: 'edit-employee-record/:id', component: EmployeeRecordFormComponent, canActivate: [authGuard] },

  //Employee Assigned Shifts
  { path: 'assigned-shifts', component: EmployeeAssignedShiftListComponent },
  { path: 'employee-assigned-shift/:id', component: EmployeeAssignedShiftDetailComponent },
  { path: 'add-employee-assigned-shift', component: EmployeeAssignedShiftFormComponent },
  { path: 'edit-employee-assigned-shift/:id', component: EmployeeAssignedShiftFormComponent },

  { path: '', redirectTo: '/login', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}