// principal.service.ts
import { Injectable, Renderer2, RendererFactory2 } from '@angular/core';

interface ClassieFunctions {
  hasClass(elem: HTMLElement, className: string): boolean;
  addClass(elem: HTMLElement, className: string): void;
  removeClass(elem: HTMLElement, className: string): void;
}

@Injectable({
  providedIn: 'root',
})
export class PrincipalService implements ClassieFunctions {
  private renderer: Renderer2;

  constructor(private rendererFactory: RendererFactory2) {
    this.renderer = rendererFactory.createRenderer(null, null);

    // Cargar scripts después de crear el servicio
    this.loadScript('Desplegable.js');
    this.loadScript('js/polyfills.js');
    this.loadScript('EventListener.js');
  }
  hasClass(elem: HTMLElement, className: string): boolean {
    throw new Error('Method not implemented.');
  }
  addClass(elem: HTMLElement, className: string): void {
    throw new Error('Method not implemented.');
  }
  removeClass(elem: HTMLElement, className: string): void {
    throw new Error('Method not implemented.');
  }

  public loadScript(scriptSrc: string): Promise<void> {
    return new Promise((resolve, reject) => {
      console.log('Preparing to load script:', scriptSrc);
      const script = this.renderer.createElement('script');
      script.type = 'text/javascript';
      script.src = scriptSrc;
      script.async = true;

      script.onload = () => {
        console.log('Script loaded successfully:', scriptSrc);
        resolve();
      };

      script.onerror = () => {
        console.error('Error loading script:', scriptSrc);
        reject();
      };

      this.renderer.appendChild(document.body, script);
    });
  }
}
