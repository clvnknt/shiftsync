import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { RoleService } from '../../services/role.service';

@Component({
  selector: 'app-role-detail',
  templateUrl: './role-detail.component.html',
  styleUrls: ['./role-detail.component.scss']
})
export class RoleDetailComponent implements OnInit {
  role: any;

  constructor(
    private roleService: RoleService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.roleService.getRole(+id).subscribe({
        next: role => this.role = role,
        error: err => console.error('Failed to fetch role:', err)
      });
    }
  }
}