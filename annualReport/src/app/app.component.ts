import { Component, OnDestroy, HostListener } from '@angular/core';
import { Router, RouterEvent, NavigationStart, NavigationEnd, NavigationCancel, NavigationError } from '@angular/router';
import {
  takeUntil, Subject
} from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnDestroy{
  title = 'BÁO CÁO THƯỜNG NIÊN TTC BIÊN HOÀ 2022-2023';
  unsubscribe = new Subject<void>();

  loading = true;

  constructor(private router: Router) {
    this.router.events.pipe(takeUntil(this.unsubscribe))
      .subscribe((routerEvent) => {
        this.checkRouterEvent(routerEvent as RouterEvent);
      });
  }

  checkRouterEvent(routerEvent: RouterEvent): void {
    if (routerEvent instanceof NavigationStart) {
      this.loading = true;
    }

    if (routerEvent instanceof NavigationEnd ||
        routerEvent instanceof NavigationCancel ||
        routerEvent instanceof NavigationError) {
        setTimeout(()=>{
          this.loading = false;
        }, 1000);
    }
  }

  ngOnDestroy(): void {
    this.unsubscribe.next();
  }
}
