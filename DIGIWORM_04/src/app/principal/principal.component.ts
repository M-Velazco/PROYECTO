import { PrincipalService } from './../principal.service';
// principal.component.ts
import { Component } from '@angular/core';


@Component({
  selector: 'app-principal',
  templateUrl: './principal.component.html',
  styleUrls: ['./principal.component.css', './css/Desplegable.css'],
})
export class PrincipalComponent {
  constructor(private PrincipalService: PrincipalService) {}

  desplegar() {
    const button = document.getElementById('cn-button');
    const wrapper = document.getElementById('cn-wrapper');

    if (button && wrapper) {
      if (!this.PrincipalService.hasClass(wrapper, 'opened-nav')) {
        button.innerHTML = 'Cerrar';
        this.PrincipalService.addClass(wrapper, 'opened-nav');
      } else {
        button.innerHTML = 'Menu';
        this.PrincipalService.removeClass(wrapper, 'opened-nav');
      }
    }
  }
}
