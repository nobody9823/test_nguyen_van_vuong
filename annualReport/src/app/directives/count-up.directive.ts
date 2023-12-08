import { Directive, ElementRef, Input, OnInit, Renderer2, HostListener } from '@angular/core';
import {
  BehaviorSubject
} from 'rxjs';
import { Destroy } from '../destroy';
import {counterUp} from 'counterup2';

@Directive({
  selector: '[countUp]',
  providers: [Destroy],
})
export class CountUpDirective implements OnInit {
  private readonly count$ = new BehaviorSubject(0);
  private readonly duration$ = new BehaviorSubject(2000);
  callback = (entries : any) => {
    entries.forEach((entry : any) => {
      if (entry.isIntersecting) {
        this.displayCurrentCount();
      }
    });
  };

  @Input('countUp')
  set count(count: number) {
    this.count$.next(count);
  }

  @Input()
  set duration(duration: number) {
    this.duration$.next(duration);
  }

  constructor(
    private readonly elementRef: ElementRef
  ) {}

  ngOnInit(): void {
    const IO = new IntersectionObserver( this.callback, { threshold: 1 } );
    IO.observe( this.elementRef.nativeElement );
  }

  private displayCurrentCount(): void {
    counterUp(this.elementRef.nativeElement, {
      duration: 1000
    });
  }
}
