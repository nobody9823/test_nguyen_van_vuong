import { Component, Input } from '@angular/core';
import { IconTypes } from '../title-logo/title-logo.component';

@Component({
  selector: 'app-title-logo2',
  templateUrl: './title-logo2.component.html',
  styleUrls: ['./title-logo2.component.css']
})
export class TitleLogo2Component {
  @Input() iconType: IconTypes = IconTypes.TitleLogo;
  readonly IconTypes = IconTypes;
}
