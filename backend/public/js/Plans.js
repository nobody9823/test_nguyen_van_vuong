const Plans = (() => {

    const getPlanIds = () => {
        return document.getElementsByClassName('plan_ids');
    };

    const getAmountById = (id) => {
        return document.getElementById('plan_amount_' + id);
    };

    const getTotalPrice = () => {

        let total_price = 0;

        let check_box = getPlanIds();

        for (let $i = 0; $i < check_box.length; $i ++){
            if (check_box[$i].checked){

                let price = check_box[$i].value;

                let amount = getAmountById(check_box[$i].id);

                total_price += (price * amount.value);
            }
        }
        return total_price;
    };

    const getTotalAmount = () => {
        return document.getElementById('total_amount');
    };

    return {
        planIsChecked: (el) => {
            let selected_card = document.getElementById('plan_card_' + el.id)

            let total_amount = getTotalAmount();

            let selected_amount = getAmountById(el.id);

            if(selected_amount.disabled){
                selected_card.classList.add('asr_current')
                selected_amount.disabled = false;
            } else {
                selected_card.classList.remove('asr_current')
                selected_amount.disabled = true;
            }
            total_amount.value = getTotalPrice();
        },
        planAmountIsChanged: () => {

            let total_amount = getTotalAmount();

            total_amount.value = getTotalPrice();
        },
        addTotalAmount: () => {
            let total_amount = getTotalAmount();

            let display_added_price = document.getElementById('display_added_price');

            num = Number(total_amount.value);

            num += 500;

            total_amount.value = num;

            display_added_price.value = Number(display_added_price.value) + 500;
        },
        subTotalAmount: () => {

            let total_amount = getTotalAmount();

            let total_price = getTotalPrice();

            let display_added_price = document.getElementById('display_added_price');

            if (total_amount.value === '' || Number(total_amount.value) <= total_price){
                return ;
            } else {
                num = Number(total_amount.value);

                num -= 500;

                total_amount.value = num;

                display_added_price.value = Number(display_added_price.value) - 500;
            }
        },
        searchCheckedPlans: () => {

            let total_amount = getTotalAmount();

            let total_price = getTotalPrice();

            let checkboxElements = getPlanIds();

            let checkedPlans = [];

            for (var i = 0, len = checkboxElements.length; i < len; i++) {
                if (checkboxElements[i].checked) {
                    checkedPlans.push(checkboxElements[i]);
                }
            }

            for($i = 0; $i < checkedPlans.length; $i++){
                let selected_amount = getAmountById(checkedPlans[$i].id);
                selected_amount.disabled = false;
            };
            total_amount.value = Number(total_price);
        },
    }
})()
