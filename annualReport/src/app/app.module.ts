import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { ButtonNavComponent } from './components/button-nav.component';
import { VisualComponent } from './components/visual/visual.component';
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
import { CupIconComponent } from './components/vectors/cup-icon/cup-icon.component';
import { VietnamMapComponent } from './components/vectors/vietnam-map/vietnam-map.component';
import { TtcLogo3Component } from './components/vectors/ttc-logo3/ttc-logo3.component';
import { TongQuanVeTtcAgrisComponent } from './content-pages/tong-quan-ve-ttc-agris/tong-quan-ve-ttc-agris.component';
import { TitleLogo2Component } from './components/vectors/title-logo2/title-logo2.component';
import { DauAnSvg1Component } from './components/vectors/dau-an-svg1/dau-an-svg1.component';
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
import { SectionContent1Component } from './components/vectors/quan-tri/section-content1/section-content1.component';
import { Section2Logo1Component } from './components/vectors/quan-tri/section2-logo1/section2-logo1.component';
import { BackToTopComponent } from './components/back-to-top/back-to-top.component';
import { Section2Content2Component } from './components/vectors/quan-tri/section2-content2/section2-content2.component';
import { TtcLogo4Component } from './components/vectors/ttc-logo4/ttc-logo4.component';
import { Section3TitleComponent } from './components/vectors/quan-tri/section3-title/section3-title.component';
import { Section4TitleComponent } from './components/vectors/quan-tri/section4-title/section4-title.component';
import { PhatTrienBenVungComponent } from './content-pages/phat-trien-ben-vung/phat-trien-ben-vung.component';
import { Section5TitleComponent } from './components/vectors/quan-tri/section5-title/section5-title.component';
import { Section6TitleComponent } from './components/vectors/quan-tri/section6-title/section6-title.component';
import { Section7TitleComponent } from './components/vectors/quan-tri/section7-title/section7-title.component';
import { RegulartionDescription4ContentComponent } from './components/vectors/quan-tri/regulartion-description4-content/regulartion-description4-content.component';
import { RegulartionDescription6ContentComponent } from './components/vectors/quan-tri/regulartion-description6-content/regulartion-description6-content.component';
import { RegulartionDescription8ContentComponent } from './components/vectors/quan-tri/regulartion-description8-content/regulartion-description8-content.component';
import { RegulartionDescription9ContentComponent } from './components/vectors/quan-tri/regulartion-description9-content/regulartion-description9-content.component';
import { Section8TitleComponent } from './components/vectors/quan-tri/section8-title/section8-title.component';
import { Section10TitleComponent } from './components/vectors/quan-tri/section10-title/section10-title.component';
import { Section9TitleComponent } from './components/vectors/quan-tri/section9-title/section9-title.component';
import { RelationDescriptionComponent } from './components/vectors/quan-tri/relation-description/relation-description.component';
import { RelationTableComponent } from './components/vectors/quan-tri/relation-table/relation-table.component';
import { RelationDescription2Component } from './components/vectors/quan-tri/relation-description2/relation-description2.component';
import { ReportDescription2Component } from './components/vectors/quan-tri/report-description2/report-description2.component';
import { ReportDescription3Component } from './components/vectors/quan-tri/report-description3/report-description3.component';
import { ReportDescription4Component } from './components/vectors/quan-tri/report-description4/report-description4.component';
import { ReportDescription5Component } from './components/vectors/quan-tri/report-description5/report-description5.component';
import { ReportDescription6Component } from './components/vectors/quan-tri/report-description6/report-description6.component';
import { ReportDescription7Component } from './components/vectors/quan-tri/report-description7/report-description7.component';
import { ReportDescription8Component } from './components/vectors/quan-tri/report-description8/report-description8.component';
import { ReportDescription9Component } from './components/vectors/quan-tri/report-description9/report-description9.component';
import { ReportDescription10Component } from './components/vectors/quan-tri/report-description10/report-description10.component';
import { ReportDescription11Component } from './components/vectors/quan-tri/report-description11/report-description11.component';
import { ReportDescription12Component } from './components/vectors/quan-tri/report-description12/report-description12.component';
import { ReportDescription13Component } from './components/vectors/quan-tri/report-description13/report-description13.component';
import { ReportDescription14Component } from './components/vectors/quan-tri/report-description14/report-description14.component';
import { ReportDescription15Component } from './components/vectors/quan-tri/report-description15/report-description15.component';
import { ReportDescription16Component } from './components/vectors/quan-tri/report-description16/report-description16.component';
import { ReportDescription17Component } from './components/vectors/quan-tri/report-description17/report-description17.component';
import { ReportDescription18Component } from './components/vectors/quan-tri/report-description18/report-description18.component';
import { ReportDescription19Component } from './components/vectors/quan-tri/report-description19/report-description19.component';
import { ReportDescription20Component } from './components/vectors/quan-tri/report-description20/report-description20.component';

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
    FooterComponent,
    SectionContent1Component,
    Section2Logo1Component,
    BackToTopComponent,
    Section2Content2Component,
    TtcLogo4Component,
    Section3TitleComponent,
    Section4TitleComponent,
    PhatTrienBenVungComponent,
    Section5TitleComponent,
    Section6TitleComponent,
    Section7TitleComponent,
    RegulartionDescription4ContentComponent,
    RegulartionDescription6ContentComponent,
    RegulartionDescription8ContentComponent,
    RegulartionDescription9ContentComponent,
    Section8TitleComponent,
    Section10TitleComponent,
    Section9TitleComponent,
    RelationDescriptionComponent,
    RelationTableComponent,
    RelationDescription2Component,
    ReportDescription2Component,
    ReportDescription3Component,
    ReportDescription4Component,
    ReportDescription5Component,
    ReportDescription6Component,
    ReportDescription7Component,
    ReportDescription8Component,
    ReportDescription9Component,
    ReportDescription10Component,
    ReportDescription11Component,
    ReportDescription12Component,
    ReportDescription13Component,
    ReportDescription14Component,
    ReportDescription15Component,
    ReportDescription16Component,
    ReportDescription17Component,
    ReportDescription18Component,
    ReportDescription19Component,
    ReportDescription20Component,
  ],
  imports: [BrowserModule, AppRoutingModule],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
