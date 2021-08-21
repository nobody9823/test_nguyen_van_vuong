@extends('user.layouts.base')

@section('title', '活動報告一覧')

@section('content')
<section id="supported-projects" class="section_base">

    <div class="tit_L_01 E-font">
        <h2>REPORTS</h2>
        <div class="sub_tit_L">活動報告一覧</div>
    </div>

    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>

        <div class="prof_page_R">
            <table class="report_table">
                <tr>
                    <th>作成日</th>
                    <!-- TODO:こちらは将来必要になった際に追加する -->
                    <!-- <th>公開設定</th> -->
                    <th>タイトル</th>
                    <th>編集</th>
                </tr>
                @if($reports)
                    @foreach($reports as $report)
                    <tr class="prof_edit_row">
                        <td>
                            <div>{{ $report->created_at->format('Y年m月d日') }}<br>
                            <span>{{ $report->created_at->format('H:m') }}</span></div>  
                        </td>
                        <td>
                          {{ $report->title }}
                        </td>
                        <td class="report_icons">
                            <!-- <i class="fas fa-ellipsis-h fa-lg"></i>
                            <i class="far fa-trash-alt"></i> -->
                            <i class="far fa-edit fa-lg"></i>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
            
            <div class="def_btn" style="margin: 100px 170px;">
              <button type="submit" class="disable-btn">
                <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">投稿する</p>
              </button>
            </div>

            <div style="margin: 100px 0;">
              <x-common.pagination :props="$reports"/>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
  .report_table tr:first-child {
    width: 100%;
    display: flex;
    background: #F7FDFF;
    color: #00AEBD;
  }

  .report_table tr:first-child th {
    margin: 20px;
  }

  .report_table th:nth-child(2) {
    width: 535px;
  }

  .prof_edit_row td:nth-child(2) {
    width: 400px;
  }
  
  .prof_edit_row td {
    height: 100px;
    display: flex;
    align-items: center;
  }

  .report_icons .fa-edit, .prof_edit_row td:nth-child(2) {
    position: relative;
    right: 25px;
  }
</style>