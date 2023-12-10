import { Component, ElementRef, Renderer2 } from '@angular/core';

@Component({
  selector: 'app-content-pages',
  templateUrl: './content-pages.component.html',
  styleUrls: ['./content-pages.component.css'],
})
export class ContentPagesComponent {
  isOpenNav: boolean = false;
  expandingNav: number = 0;
  navList = [
    {
      index: 1,
      title: 'TTC AgriS - Dấu ấn niên độ',
      children: [
        { title: 'Tầm nhìn - Sứ mệnh - Giá trị cốt lõi', navId: 'info-4' },
        { title: 'Thông điệp Chủ tịch Hội đồng Quản trị', navId: 'info-5' },
        { title: 'Thông điệp Phó chủ tịch Hội đồng Quản trị', navId: 'info-6' },
        { title: 'Chia sẻ từ Ban Điều hành', navId: 'info-1' },
        { title: 'Những con số nổi bật niên độ 2022-2023', navId: 'info-1' },
        { title: 'Những sự kiện nổi bật niên độ 2022-2023', navId: 'info-1' },
        { title: 'Dấu ấn TTC AgriS Innovation Day', navId: 'info-1' },
        { title: 'Điểm nhấn tài chính 2018-2019 đến 2022-2023', navId: 'info-1' },
      ],
    },
    {
      index: 2,
      title: 'Tổng quan về TTC AgriS',
      children: [
        { title: 'Hành trình 54 năm thương hiệu TTC AgriS', navId: 'section-2' },
        { title: 'Hồ sơ doanh nghiệp', navId: 'section-4' },
        { title: 'Hệ thống mạng lưới của TTC AgriS', navId: 'section-7' },
        { title: 'Toàn diện chuỗi giá trị cây trồng, kiến tạo nền nông nghiệp tuần hoàn bền vững', navId: 'section-16' },
        { title: 'Danh mục sản phẩm đa dạng của TTC AgriS', navId: 'section-19' },
        { title: 'Kênh phân phối chính', navId: 'section-20' },
      ],
    },
    {
      index: 3,
      title: 'Quản trị Công ty',
      children: [
        { title: 'Quy chế Quản trị Công ty thông lệ quốc tế', navId: 'info-1' },
        { title: 'Giới thiệu Hội đồng Quản trị', navId: 'info-1' },
        { title: 'Báo cáo của Hội đồng quản trị', navId: 'info-1' },
        { title: 'Định hướng chiến lược của Hội đồng Quản trị', navId: 'info-1' },
        { title: 'Báo cáo của Thành viên độc lập HĐQT', navId: 'info-1' },
        { title: 'Báo cáo của Ủy ban Kiểm toán', navId: 'info-1' },
        { title: 'Báo cáo các Ủy ban khác trực thuộc HĐQT', navId: 'info-1' },
        { title: 'Bộ Quy chế ứng xử 150 Quản trị rủi ro', navId: 'info-1' },
        { title: 'Tuân thủ pháp luật', navId: 'info-1' },
        { title: 'Quan hệ Nhà đầu tư', navId: 'info-1' },
        { title: 'Báo cáo và phân tích Quản trị Công ty', navId: 'info-1' },
      ],
    },
    {
      index: 4,
      title: 'Tình hình hoạt động trong năm',
      children: [
        // { title: 'Triển vọng Đường thế giới', navId: 'info-1' },
        // { title: 'Triển vọng Đường Việt Nam', navId: 'info-1' },
        // { title: 'Thị trường Thực phẩm và Đồ uống (F&B) - Tiềm năng và cơ hội', navId: 'info-1' },
        // { title: 'Tận dụng lợi thế cạnh tranh, bứt phá trên phạm vi toàn cầu', navId: 'info-1' },
        // { title: 'Giới thiệu Ban Tổng Giám đốc', navId: 'info-1' },
        // { title: 'Báo cáo của Ban Tổng Giám đốc về hoạt động trong năm', navId: 'info-1' },
        // { title: 'Thông tin cổ phiếu', navId: 'info-1' },
        { title: 'Đang khởi tạo...', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
        // { title: '', navId: 'info-1' },
      ],
    },
    {
      index: 5,
      title: 'Báo cáo phát triển bền vững',
      children: [
        { title: 'Cam kết Phát triển bền vững từ Hội đồng Quản trị', navId: 'info-1' },
        { title: '17 tiêu chí phát triển bền vững của Liên Hợp Quốc', navId: 'info-1' },
        { title: 'Sự tham gia của các Bên liên quan', navId: 'info-1' },
        { title: 'Chủ đề Kinh tế', navId: 'info-1' },
        { title: 'Chủ đề Môi trường', navId: 'info-1' },
        { title: 'Chủ đề Xã hội', navId: 'info-1' },
      ],
    },
    {
      index: 6,
      title: 'Báo cáo tài chính',
      children: [
        { title: 'Báo cáo tài chính kiểm toán hợp nhất 22/23 (VAS)', navId: 'info-1' },
        { title: 'Báo cáo tài chính kiểm toán riêng 22/23 (VAS)', navId: 'info-1' },
      ],
    },
  ];
  constructor(private renderer: Renderer2, private elementRef: ElementRef) {}
  onClickNav(elementId: string) {
    const element = document.getElementById(elementId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
  }
  onClickMobileNav(elementId: string) {
    this.isOpenNav = !this.isOpenNav;
    this.onClickNav(elementId);
  }

  toggleNav() {
    if (!this.isOpenNav) {
      const pageContent =
        this.elementRef.nativeElement.querySelector('#page-content');
      this.renderer.addClass(pageContent, 'nav-open');
    }
    this.isOpenNav = !this.isOpenNav;
  }

  onExpandNav(index?: number) {
    this.expandingNav = index ?? 0;
  }
  onCloseExpandNav() {
    this.expandingNav = 0;
  }
}
