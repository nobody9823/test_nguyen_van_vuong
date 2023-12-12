import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HoatDongTrongNamComponent } from './hoat-dong-trong-nam.component';

describe('HoatDongTrongNamComponent', () => {
  let component: HoatDongTrongNamComponent;
  let fixture: ComponentFixture<HoatDongTrongNamComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [HoatDongTrongNamComponent]
    });
    fixture = TestBed.createComponent(HoatDongTrongNamComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
