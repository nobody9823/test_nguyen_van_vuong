import { Component } from '@angular/core';
import { IconTypes } from 'src/app/components/vectors/title-logo/title-logo.component';

@Component({
  selector: 'app-dau-an-nien-do',
  templateUrl: './dau-an-nien-do.component.html',
  styleUrls: ['./dau-an-nien-do.component.css']
})
export class DauAnNienDoComponent {
  readonly IconTypes = IconTypes;

  block8Content1: any[] = [
    {
      rank: 'TOP 5',
      content1: 'DOANH NGHIỆP QUẢN TRỊ CÔNG TY TỐT NHẤT 2022',
      content2: '- NHÓM VỐN HÓA LỚN - HOSE',
    },
    {
      rank: 'TOP 10',
      content1: 'DOANH NGHIỆP PHÁT TRIỂN KINH TẾ XANH BỀN VỮNG',
      content2: 'NĂM 2022 - VICETA',
    },
    {
      rank: 'TOP 50',
      content1: 'CÔNG TY NIÊM YẾT TỐT NHẤT NĂM 2023 -',
      content2: 'FORBES VIỆT NAM',
    },
    {
      rank: 'TOP 4',
      content1: 'BÁO CÁO THƯỜNG NIÊN XUẤT SẮC NHẤT THẾ GIỚI -',
      content2: 'HIỆP HỘI TRUYỀN THÔNG CHUYÊN NGHIỆP HOA KỲ (LACP)',
    },
  ];
}
