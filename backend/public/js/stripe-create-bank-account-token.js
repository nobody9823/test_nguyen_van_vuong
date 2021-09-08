accountNumber = document.getElementById('accountNumber');
holderName = document.getElementById('holderName');
bankCode = document.getElementById('bankCode');
branchCode = document.getElementById('branchCode');
const createBankAccountToken = () => {
    stripe.createToken('bank_account', {
            country: 'JP',
            currency: 'jpy',
            routing_number: bankCode.value + branchCode.value,
            account_number: accountNumber.value,
            account_holder_name: holderName.value,
            account_holder_type: 'individual',
        })
        .then((result) => {
            // Handle result.error or result.token
            if (result.error) {
                console.log(result.error)
            } else {
                axios.post('/update_external_account', {bankToken: result.token.id})
                    .then((res) => {
                        console.log(res);
                    })
                    .catch((res) => {
                        console.log(res);
                    });
            }
        })
}
accountNumber.addEventListener('change', () => {
    createBankAccountToken();
});
holderName.addEventListener('change', () => {
    createBankAccountToken();
});
bankCode.addEventListener('change', () => {
    createBankAccountToken();
});
branchCode.addEventListener('change', () => {
    createBankAccountToken();
});
