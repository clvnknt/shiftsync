import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { UsersComponent } from './components/users/users.component';
import { UserFormComponent } from './components/user-form/user-form.component'; // Import UserFormComponent
import { UserDetailComponent } from './components/user-detail/user-detail.component'; // Import UserDetailComponent
import { DepartmentsComponent } from './components/departments/departments.component'; // Import DepartmentsComponent
import { DepartmentFormComponent } from './components/department-form/department-form.component'; // Import DepartmentFormComponent
import { DepartmentDetailComponent } from './components/department-detail/department-detail.component'; // Import DepartmentDetailComponent

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'users', component: UsersComponent },
  { path: 'add-user', component: UserFormComponent }, 
  { path: 'view-user/:id', component: UserDetailComponent }, // Add route for view user
  { path: 'edit-user/:id', component: UserFormComponent }, // Add route for edit user
  { path: 'departments', component: DepartmentsComponent }, // Add route for departments list
  { path: 'add-department', component: DepartmentFormComponent }, // Add route for add department
  { path: 'view-department/:id', component: DepartmentDetailComponent }, // Add route for view department
  { path: 'edit-department/:id', component: DepartmentFormComponent }, // Add route for edit department
  { path: '', redirectTo: '/login', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}