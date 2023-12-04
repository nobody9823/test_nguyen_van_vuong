import { Component, OnDestroy } from '@angular/core';
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
  title = 'annualReport';
  unsubscribe = new Subject<void>();

  loading = true;

  constructor(private router: Router) {
    console.log('subscribing ...');
    this.router.events.pipe(takeUntil(this.unsubscribe))
      .subscribe((routerEvent) => {
        this.checkRouterEvent(routerEvent as RouterEvent);
      });
  }

  checkRouterEvent(routerEvent: RouterEvent): void {
    if (routerEvent instanceof NavigationStart) {
      this.loading = true;
      console.log('starting.');
    }

    if (routerEvent instanceof NavigationEnd ||
        routerEvent instanceof NavigationCancel ||
        routerEvent instanceof NavigationError) {
        this.loading = false;
        console.log('done.');
    }
  }

  ngOnDestroy(): void {
    this.unsubscribe.next();
  }

}
