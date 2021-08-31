var elements = stripe.elements({
    // fonts: [
    //   {
    //     cssSrc: 'https://fonts.googleapis.com/css?family=Quicksand',
    //   },
    // ],
    // Stripe's examples are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: 'auto',
});

var number_errors = document.getElementById('number_errors');
var cvc_errors = document.getElementById('cvc_errors');
var expiry_errors = document.getElementById('expiry_errors');

// フォームのスタイル
var formStyle = {
    base: {
        color: '#707070',
        fontFamily: 'YuGothic',
        fontSize: '14px',
        fontWeight: 'bold',
        fontStyle: 'normal',
        letterSpacing: 'normal',
        textAlign: 'left',
        fontSmoothing: 'antialiased',
        ':-webkit-autofill': {
            color: '#fce883',
        },
        '::placeholder': {
            color: '#dbdbdb',
        },
    },
    invalid: {
        iconColor: '#FFC7EE',
        color: 'red',
    },
}

// カード番号フォームの生成
var numberElement = elements.create(
    'cardNumber',
    {
        style: formStyle,
    }
);
numberElement.mount('#number-form');

// 有効期限フォームの生成
var expiryElement = elements.create(
    'cardExpiry',
    {
        style: formStyle,
    }
);
expiryElement.mount('#expiry-form');

// セキュリティコードフォームの生成
var cvcElement = elements.create(
    'cardCvc',
    {
        style: formStyle,
    }
);
cvcElement.mount('#cvc-form');

// 各フォームに正しい値が入っているかどうか
let numberElIsCompleted = false;
let expiryElIsCompleted = false;
let cvcElIsCompleted = false;

numberElement.on('change', (event) => {
    number_errors.innerHTML = '';
    if (event.error) {
        number_errors.innerHTML = event.error.message;
    }
    numberElIsCompleted = event.complete
});
cvcElement.on('change', (event) => {
    cvc_errors.innerHTML = '';
    if (event.error) {
        cvc_errors.innerHTML = event.error.message;
    }
    cvcElIsCompleted = event.complete
});
expiryElement.on('change', (event) => {
    expiry_errors.innerHTML = '';
    if (event.error) {
        expiry_errors.innerHTML = event.error.message;
    }
    expiryElIsCompleted = event.complete
});

// フォームからフォーカスを外したときにpaymentMethodを作成する
numberElement.on('blur', async (e) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: numberElement,
            // billing_details: {
            //     name: 'Jenny Rosen',
            // },
        });

        if (error) {
            // "error.message"をユーザーに表示…
            console.log(error);
            number_errors.innerHTML = error.message;
        } else {
            // カードは正常に検証された…
            console.log(paymentMethod);
            console.log(paymentMethod.id);
            document.querySelector('#payment_method_id').value = paymentMethod.id;
            number_errors.innerHTML = ''
        }
    }
});
cvcElement.on('blur', async (e) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: numberElement,
            // billing_details: {
            //     name: 'Jenny Rosen',
            // },
        });

        if (error) {
            // "error.message"をユーザーに表示…
            console.log(error);
            cvc_errors.innerHTML = error.message;
        } else {
            // カードは正常に検証された…
            console.log(paymentMethod);
            console.log(paymentMethod.id);
            document.querySelector('#payment_method_id').value = paymentMethod.id;
            cvc_errors.innerHTML = ''
        }
    }
});
expiryElement.on('blur', async (e) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: numberElement,
            // billing_details: {
            //     name: 'Jenny Rosen',
            // },
        });

        if (error) {
            // "error.message"をユーザーに表示…
            console.log(error);
            expiry_errors.innerHTML = error.message;
        } else {
            // カードは正常に検証された…
            console.log(paymentMethod);
            console.log(paymentMethod.id);
            document.querySelector('#payment_method_id').value = paymentMethod.id;
            expiry_errors.innerHTML = ''
        }
    }
});
