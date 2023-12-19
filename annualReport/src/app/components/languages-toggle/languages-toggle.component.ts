import { Component } from '@angular/core';
import { Router, RouterEvent, NavigationEnd } from '@angular/router';
import { Subject } from 'rxjs';
@Component({
  selector: 'app-languages-toggle',
  templateUrl: './languages-toggle.component.html',
  styleUrls: ['./languages-toggle.component.css']
})
export class LanguagesToggleComponent {
  router: Router;
  unsubscribe = new Subject<void>();
  inEnglish: boolean = false;
  englishUrl = '';
  vietnamUrl = '';

  constructor(router: Router) {
    this.router = router;
    this.router.events.subscribe((routerEvent) => {
      this.checkRouterEvent(routerEvent as RouterEvent);
    });
  }

  checkRouterEvent(routerEvent: RouterEvent): void {
    if (routerEvent instanceof NavigationEnd) {
      this.inEnglish = this.isEnglish(this.router.url);
      if(this.inEnglish){
        this.englishUrl = this.router.url;
        this.vietnamUrl = this.router.url.replace('2022-2023/en','2022-2023/vi');
      }
      else{
        this.vietnamUrl = this.router.url;
        this.englishUrl = this.router.url.replace('2022-2023/vi','2022-2023/en');
      }
    }

  }

  isEnglish(url: string){
    return url != undefined && url.includes('2022-2023/en');
  }
}
