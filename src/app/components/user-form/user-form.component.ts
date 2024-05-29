import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.scss']
})
export class UserFormComponent implements OnInit {
  user: any = {name: '', email: '', password: ''}; // Add default password field for create user
  isEdit: boolean = false;

  constructor(
    private userService: UserService,
    private authService: AuthService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEdit = true;
      this.userService.getUser(+id).subscribe({
        next: user => this.user = user,
        error: err => console.error('Failed to fetch user:', err)
      });
    }
  }

  saveUser(): void {
    if (this.isEdit) {
      this.userService.updateUser(this.user.id, this.user).subscribe({
        next: () => this.router.navigate(['/users']),
        error: err => console.error('Failed to update user:', err)
      });
    } else {
      this.userService.addUser(this.user).subscribe({
        next: () => this.router.navigate(['/users']),
        error: err => console.error('Failed to add user:', err)
      });
    }
  }
}