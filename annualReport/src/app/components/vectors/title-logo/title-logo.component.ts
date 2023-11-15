import { Component, Input } from '@angular/core';

export enum IconTypes {
  TitleLogo,
  TitleLogo2
}
@Component({
  selector: 'app-title-logo',
  templateUrl: './title-logo.component.html',
  styleUrls: ['./title-logo.component.css']
})
export class TitleLogoComponent {
  @Input() iconType: IconTypes = IconTypes.TitleLogo;
  readonly IconTypes = IconTypes;
}
