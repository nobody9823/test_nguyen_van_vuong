var elements = payjp.elements()
var number_errors = document.getElementById('number_errors');
var expiry_errors = document.getElementById('expiry_errors');
var cvc_errors = document.getElementById('cvc_errors');

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

// 入力フォームを分解して管理・配置できます
var numberElement = elements.create('cardNumber', {style: formStyle})
var expiryElement = elements.create('cardExpiry', {style: formStyle})
var cvcElement = elements.create('cardCvc', {style: formStyle})

numberElement.mount('#number-form')
expiryElement.mount('#expiry-form')
cvcElement.mount('#cvc-form')

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
expiryElement.on('change', (event) => {
    expiry_errors.innerHTML = '';
    if (event.error) {
        expiry_errors.innerHTML = event.error.message;
    }
    expiryElIsCompleted = event.complete
});
cvcElement.on('change', (event) => {
    cvc_errors.innerHTML = '';
    if (event.error) {
        cvc_errors.innerHTML = event.error.message;
    }
    cvcElIsCompleted = event.complete
});
numberElement.on('blur', (event) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        payjp.createToken(numberElement).then((response) => {
            if (response.error) {
                number_errors.innerHTML = response.error.message;
                return false;
            } else {
                document.querySelector('#payjp_token').value = response.id;
                console.log(response);
                number_errors.innerHTML = ''
            };
        })
    }
});
expiryElement.on('blur', (event) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        payjp.createToken(numberElement).then((response) => {
            if (response.error) {
                expiry_errors.innerHTML = response.error.message;
                return false;
            } else {
                document.querySelector('#payjp_token').value = response.id;
                console.log(response);
                expiry_errors.innerHTML = ''
            };
        })
    }
});
cvcElement.on('blur', (event) => {
    if (numberElIsCompleted && expiryElIsCompleted && cvcElIsCompleted) {
        payjp.createToken(numberElement).then((response) => {
            if (response.error) {
                cvc_errors.innerHTML = response.error.message;
                return false;
            } else {
                document.querySelector('#payjp_token').value = response.id;
                console.log(response);
                cvc_errors.innerHTML = ''
            };
        })
    }
});
