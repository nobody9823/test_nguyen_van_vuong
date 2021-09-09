const displayIndividualStatus = (pastDue) => {
    const ul = document.createElement('ul');
    if (pastDue.includes('individual.first_name_kanji') || pastDue.includes('individual.last_name_kanji')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '名前（漢字、ひらがな）';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.first_name_kana') || pastDue.includes('individual.last_name_kana')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '名前（カナ）';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.phone')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '電話番号';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.address_kana.postal_code') || pastDue.includes('individual.address_kanji.postal_code') || pastDue.includes('individual.address_kanji.line1') || pastDue.includes('individual.address_kanji.line1')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '住所';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.dob.day') || pastDue.includes('individual.dob.month') || pastDue.includes('individual.dob.year')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '生年月日';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.email')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = 'メールアドレス';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('external_account')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '銀行口座情報';
        ul.appendChild(childElement);
    }
    if (pastDue.includes('individual.verification.document')) {
        var childElement = document.createElement('li');
        childElement.innerHTML = '本人確認書類（設定後、担当者にご連絡ください。）';
        ul.appendChild(childElement);
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "0",
        "timeOut": 0,
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false
    }
    toastr["warning"](ul, "以下の項目を確認し、もう一度入力してください。");
}
