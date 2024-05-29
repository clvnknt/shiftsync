import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms'; // Import FormsModule for ngModel
import { HttpClientModule } from '@angular/common/http';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { UsersComponent } from './components/users/users.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { UserFormComponent } from './components/user-form/user-form.component'; // Import UserFormComponent
import { UserDetailComponent } from './components/user-detail/user-detail.component'; // Import UserDetailComponent
import { AppRoutingModule } from './app-routing.module';
import { DepartmentsComponent } from './components/departments/departments.component';
import { DepartmentFormComponent } from './components/department-form/department-form.component';
import { DepartmentDetailComponent } from './components/department-detail/department-detail.component';

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
    DepartmentDetailComponent // Declare UserDetailComponent
  ],
  imports: [
    BrowserModule,
    FormsModule, // Add FormsModule to imports for ngModel
    HttpClientModule,
    RouterModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }