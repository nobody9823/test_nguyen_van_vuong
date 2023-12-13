import { NgModule } from "@angular/core";
import { BrowserModule } from "@angular/platform-browser";

import { AppRoutingModule } from "./app-routing.module";
import { AppComponent } from "./app.component";
import { HomeComponent } from "./home/home.component";
import { ButtonNavComponent } from "./components/button-nav.component";
import { VisualComponent } from "./components/visual/visual.component";
import { ContentPagesComponent } from './content-pages/content-pages.component';
import { DauAnNienDoComponent } from './content-pages/dau-an-nien-do/dau-an-nien-do.component';
import { LanguagesToggleComponent } from './components/languages-toggle/languages-toggle.component';
import { TitleLogoComponent } from './components/vectors/title-logo/title-logo.component';
import { NavPrefixIconComponent } from './components/vectors/nav-prefix-icon/nav-prefix-icon.component';
import { MainLogoComponent } from './components/vectors/main-logo/main-logo.component';
import { CountUpDirective } from './directives/count-up.directive';
import { SpinnerComponent } from './components/spinner/spinner.component';
import { Info3TitleComponent } from './components/vectors/info3-title/info3-title.component';
import { TtcLogo2Component } from './components/vectors/ttc-logo2/ttc-logo2.component';
import { CupIconComponent } from "./components/vectors/cup-icon/cup-icon.component";
import { VietnamMapComponent } from './components/vectors/vietnam-map/vietnam-map.component';
import { TtcLogo3Component } from './components/vectors/ttc-logo3/ttc-logo3.component';
import { TongQuanVeTtcAgrisComponent } from './content-pages/tong-quan-ve-ttc-agris/tong-quan-ve-ttc-agris.component';
import { TitleLogo2Component } from './components/vectors/title-logo2/title-logo2.component';
import { DauAnSvg1Component } from "./components/vectors/dau-an-svg1/dau-an-svg1.component";
import { DauAnSvg2Component } from './components/vectors/dau-an-svg2/dau-an-svg2.component';
import { DauAnSvg3Component } from './components/vectors/dau-an-svg3/dau-an-svg3.component';
import { DauAnSvg4Component } from './components/vectors/dau-an-svg4/dau-an-svg4.component';
import { DauAnSvg5Component } from './components/vectors/dau-an-svg5/dau-an-svg5.component';
import { DiemNhanSvg1Component } from './components/vectors/diem-nhan-svg1/diem-nhan-svg1.component';
import { DiemNhanSvg2Component } from './components/vectors/diem-nhan-svg2/diem-nhan-svg2.component';
import { ExpandNavIconComponent } from './components/vectors/expand-nav-icon/expand-nav-icon.component';
import { QuanTriCongTyComponent } from './content-pages/quan-tri-cong-ty/quan-tri-cong-ty.component';
import { HoatDongTrongNamComponent } from './content-pages/hoat-dong-trong-nam/hoat-dong-trong-nam.component';
import { Section2TitleComponent } from './components/vectors/quan-tri/section2-title/section2-title.component';
import { FooterComponent } from './components/footer/footer.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ButtonNavComponent,
    VisualComponent,
    ContentPagesComponent,
    DauAnNienDoComponent,
    LanguagesToggleComponent,
    TitleLogoComponent,
    NavPrefixIconComponent,
    MainLogoComponent,
    //MobileNavComponent,
    CountUpDirective,
    SpinnerComponent,
    Info3TitleComponent,
    TtcLogo2Component,
    CupIconComponent,
    VietnamMapComponent,
    TtcLogo3Component,
    TongQuanVeTtcAgrisComponent,
    TitleLogo2Component,
    DauAnSvg1Component,
    DauAnSvg2Component,
    DauAnSvg3Component,
    DauAnSvg4Component,
    DauAnSvg5Component,
    DiemNhanSvg1Component,
    DiemNhanSvg2Component,
    ExpandNavIconComponent,
    QuanTriCongTyComponent,
    HoatDongTrongNamComponent,
    Section2TitleComponent,
    FooterComponent
  ],
  imports: [BrowserModule, AppRoutingModule],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
