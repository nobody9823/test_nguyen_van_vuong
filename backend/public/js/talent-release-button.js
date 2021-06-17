// 処理を実行するかどうか
function ComfirmRelease(IsChecked){
    if (IsChecked === "checked") {
        var Result = confirm("非公開にしますか？");
        IsChecked = false;
    } else if (IsChecked === undefined){
        var Result = confirm("公開しますか？");
        IsChecked = true;
    }
    return Result;
}

// 公開するのか非公開にするのかをbool値で返す。
function ToChangeIsReleased(IsChecked){
    if (IsChecked === "checked") {
        IsReleased = false;
    } else if (IsChecked === undefined){
        IsReleased = true;
    }
    return IsReleased;
}

// ajaxの処理
function ToAjax(TalentId, IsReleased){
    //完了を知らせるためにDeferredオブジェクトを生成しそれを返す
    var deferred = new $.Deferred();

    $.ajax({
        url: '/admin/talent/' + TalentId + '/release/' + IsReleased,
        type: 'GET',
        data: {'id': TalentId, 'is_released': IsReleased},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        success: function(msg){
            if (msg === "success"){
                //ajax処理を終了したことをDeferredオブジェクトに通知
                deferred.resolve();
            } else if (msg === "hasEmpty") {
                alert("公開には「所属企業」「タレント名」「メールアドレス」の記入が必須です。");
            } else {
                alert("公開に失敗しました。");
            }
        }
    })
    .fail(function() {
        alert("公開に失敗しました。");
    });
    //完了を知らせるためにDeferredオブジェクトを生成しそれを返す
    return deferred;
}

// ハンドラを返す
function FetchHandler(El){
    var events = $._data(El.get(0), 'events');
    return events.click[0].handler;
}

// イベントの再登録
function ReRegisterEvent(El, OriginalHandler){
    El.off('click', OriginalHandler);
    El.on('click', OriginalHandler);
}

// ユーザーへアラート
function AlertToUser(IsReleased){
    if (IsReleased === true){
        alert("公開しました。");
    } else {
        alert("非公開にしました。");
    }
}

// ボタンのスイッチ
function ButtonSwitched (ChildrenEl, IsReleased){
    // トグルの有効化
    $(ChildrenEl).bootstrapToggle('enable');

    if (IsReleased === true){
        // トグルをonの状態に変更して、chekedする
        $(ChildrenEl).bootstrapToggle('on').attr('checked', 'checked');
    } else {
        // トグルをoffの状態に変更して、checkedを外す。
        $(ChildrenEl).bootstrapToggle('off').removeAttr('checked');
    }
}

// 公開非公開処理
function releaseButton(El){
    // 会社IDを取得
    var CompanyId = El.attr('id');

    // スライドボタン取得
    var ChildrenEl = El.find('input')[0];

    // 公開か非公開かを取得
    var IsChecked = El.find('input').attr('checked');

    // トグルの無効化
    $(ChildrenEl).bootstrapToggle('disable');

    var IsReleased = ToChangeIsReleased(IsChecked);

    var Result = ComfirmRelease(IsChecked);

    if (Result === true){
        // csrfトークンを挿入
        El.append('<meta name="csrf-token" content="{{ csrf_token() }}">');
        //ToAjax関数のリターン値としてDeferredオブジェクトを受け取る
        var deferred = ToAjax(CompanyId, IsReleased);
    } else {
        return false;
    }
    //Deferredオブジェクトを監視し、完了の通知がきたらdone内を実行
    deferred.done(function(){
        AlertToUser(IsReleased);
        ButtonSwitched(ChildrenEl, IsReleased);
        // イベントの再登録処理
        var OriginalHandler = FetchHandler(El);
        ReRegisterEvent(El, OriginalHandler);

    });
}
