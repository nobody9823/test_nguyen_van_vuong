import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DauAnNienDoComponent } from './content-pages/dau-an-nien-do/dau-an-nien-do.component';
import { ContentPagesComponent } from './content-pages/content-pages.component';
import { HomeComponent } from './home/home.component';
import { TongQuanVeTtcAgrisComponent } from './content-pages/tong-quan-ve-ttc-agris/tong-quan-ve-ttc-agris.component';
import { QuanTriCongTyComponent } from './content-pages/quan-tri-cong-ty/quan-tri-cong-ty.component';
import { HoatDongTrongNamComponent } from './content-pages/hoat-dong-trong-nam/hoat-dong-trong-nam.component';

const routes: Routes = [
  // {
  //   path: 'dau-an-nien-do',
  //   // loadChildren: () => import('./content-pages/content-pages.module').then(m => m.ContentPagesModule)
  //   component: DauAnNienDoComponent
  // }
  {
    path: '',
    component: HomeComponent,
  },
  {
    path: 'content',
    component: ContentPagesComponent,
    children: [
      {
        path: '',
        redirectTo: 'dau-an-nien-do',
        pathMatch: 'full',
      },
      {
        path: 'dau-an-nien-do',
        component: DauAnNienDoComponent,
      },
      {
        path: 'tong-quan-ve-ttc-agris',
        component: TongQuanVeTtcAgrisComponent,
      },
      {
        path: 'quan-tri-cong-ty',
        component: QuanTriCongTyComponent,
      },
      {
        path: 'hoat-dong-trong-nam',
        component: HoatDongTrongNamComponent,
      },
    ],
  },
  { path: '**', redirectTo: '' },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { scrollPositionRestoration: 'disabled' }),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
