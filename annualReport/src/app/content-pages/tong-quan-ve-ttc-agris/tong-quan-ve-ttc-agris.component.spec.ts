import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TongQuanVeTtcAgrisComponent } from './tong-quan-ve-ttc-agris.component';

describe('TongQuanVeTtcAgrisComponent', () => {
  let component: TongQuanVeTtcAgrisComponent;
  let fixture: ComponentFixture<TongQuanVeTtcAgrisComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [TongQuanVeTtcAgrisComponent]
    });
    fixture = TestBed.createComponent(TongQuanVeTtcAgrisComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
