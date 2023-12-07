// principal.component.ts
import { Component } from '@angular/core';
import { PrincipalService } from '../principal.service';

@Component({
  selector: 'app-principal',
  templateUrl: './principal.component.html',
  styleUrls: ['./principal.component.css', './css/Desplegable.css'],
})
export class PrincipalComponent {
  constructor(private principalService: PrincipalService) {}

  desplegar() {
    const button = document.getElementById('cn-button');
    const wrapper = document.getElementById('cn-wrapper');

    if (button && wrapper) {
      if (!this.principalService.hasClass(wrapper, 'opened-nav')) {
        button.innerHTML = 'Cerrar';
        this.principalService.addClass(wrapper, 'opened-nav');
      } else {
        button.innerHTML = 'Menu';
        this.principalService.removeClass(wrapper, 'opened-nav');
      }
    }
  }
}
