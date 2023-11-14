import { Component } from '@angular/core';

@Component({
  selector: 'app-content-pages',
  templateUrl: './content-pages.component.html',
  styleUrls: ['./content-pages.component.css']
})
export class ContentPagesComponent {
  onClickNav(elementId: string) {
      const element = document.getElementById(elementId);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
  }
}
