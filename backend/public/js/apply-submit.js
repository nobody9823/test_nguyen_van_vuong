// インフルエンサーのプロジェクト作成の必須項目はこちらに追加してください
const projectFields = {
    title: 'プロジェクト名',
    content: 'プロジェクト概要文',
    start_date: '掲載開始日',
    end_date: '掲載終了日',
    reward_by_total_quantity: '支援人数順PSリターン内容',
    // NOTE: こちらは支援総額順のリターンを使用する際にコメントアウトを解除してください。
    // reward_by_total_amount : '支援総額順リターン内容',
}
const planFields = {
    title: 'リターン名',
    content: 'リターン詳細',
}
const profileFields = {
    last_name: '姓',
    first_name: '名',
    last_name_kana: '姓（カナ）',
    first_name_kana: '名（カナ）',
}
const addressFields = {
    city: '市区町村',
    block: '町域',
    block_number: '番地',
}
const bankAccountFields = {
    Bank_Code: '金融機関コード / 銀行コード',
    Branch_Name: '支店番号',
    Account_Number: '口座番号',
    Account_Name: '口座名義',
}

const applySubmit = (
    project,
    plans,
    tags,
    profile,
    address,
    identification,
    bankAccount
    ) => {

    let requiredFields = [];

    const getRequiredFields = (fields, table) => {
        for (let key in fields) {
            let field = '・' + fields[key] + '\n';
            table[key] === '' && requiredFields.push(field);
        }
    }

    // プロジェクト
    if (project['target_number'] < 1)
        requiredFields.push('・目標金額\n');
    getRequiredFields(projectFields, project);

    // リターン
    if (plans.length === 0)
        requiredFields.push('・リターンを1つ以上作成してください\n');

    for (let i = 0; i < plans.length; i++) {
        for (let key in planFields) {
            let field = '・' + (i + 1) + '番目の' + planFields[key] + '\n';
            plans[i][key] === '' && requiredFields.push(field);
        }
        if (plans[i]['price'] < 1)
            requiredFields.push('・' + (i + 1) + '番目のリターン金額\n');
        if (plans[i]['image_url'] === 'public/sampleImage/now_printing.png')
            requiredFields.push('・' + (i + 1) + '番目のリターン画像\n');
    }

    // タグ
    if (tags.length < 1)
        requiredFields.push('・タグを1つ以上設定してください\n');

    // プロフィール
    getRequiredFields(profileFields, profile);
    if (profile['phone_number'] === '00000000000')
        requiredFields.push('・電話番号\n');

    // アドレス
    getRequiredFields(addressFields, address);
    if (address['postal_code'] === '0')
        requiredFields.push('・郵便番号\n');

    // 本人確認
    if (
        identification['identify_image_1'] === 'public/sampleImage/now_printing.png'
        && identification['identify_image_2'] === 'public/sampleImage/now_printing.png'
    )
        requiredFields.push('・本人確認書類\n');

    // 銀行口座
    if (bankAccount === null) {
        requiredFields.push('・銀行口座情報を入力してください\n');
    } else {
        getRequiredFields(bankAccountFields, bankAccount);
    }

    // 配列に入った必須項目フィールドを一つの文字列にまとめる
    let joinedRequiredFields = requiredFields.join('');

    if (requiredFields.length === 0) {
        // confirm('申請してもよろしいですか？') &&
            document.getElementById('apply_form').submit();
    } else {
        let validationMessage = '下記の項目を正しく入力してから申請してください。\n' + joinedRequiredFields;
        alert(validationMessage);
    }
}
