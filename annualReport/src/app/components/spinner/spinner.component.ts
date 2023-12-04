import { Component, AfterViewInit  } from '@angular/core';

@Component({
  selector: 'app-spinner',
  templateUrl: './spinner.component.html',
  styleUrls: ['./spinner.component.css']
})
export class SpinnerComponent implements AfterViewInit{
  public isLoading = true;

  ngAfterViewInit() {

    setTimeout(()=>{
      this.isLoading = false;
    }, 800);
  }
}
