const Plans = (() => {
    const getTotalPrice = () => {
        let totalPrice = 0;
        let selectablePlans = document.getElementsByClassName('plan_ids');

        for (let $i = 0; $i < selectablePlans.length; $i ++){
            if (selectablePlans[$i].checked){
                let selectedPlanPrice = selectablePlans[$i].value;

                let selectedPlanQuantity = document.getElementById(`plan_quantity_${selectablePlans[$i].id}`).value;

                totalPrice += (selectedPlanPrice * selectedPlanQuantity);
            }
        }

        return totalPrice += Number(document.getElementById('display_added_price').value);
    };

    return {
        changeSelectedPlan: (el) => {
            let selectedPlanCard = document.getElementById('plan_card_' + el.id)
            let totalAmountInputForm = document.getElementById('total_amount');
            let selectedPlanQuantitySelectBox = document.getElementById(`plan_quantity_${el.id}`);

            if(selectedPlanQuantitySelectBox.disabled){
                selectedPlanCard.classList.add('asr_current')
                selectedPlanQuantitySelectBox.disabled = false;
            } else {
                selectedPlanCard.classList.remove('asr_current')
                selectedPlanQuantitySelectBox.disabled = true;
            }

            totalAmountInputForm.value = getTotalPrice();
        },

        changePlanQuantity: () => {
            let totalAmountInputForm = document.getElementById('total_amount');

            totalAmountInputForm.value = getTotalPrice();
        },

        addTotalAmount: () => {
            let totalAmountInputForm = document.getElementById('total_amount');
            let display_added_price = document.getElementById('display_added_price');
            let num = Number(totalAmountInputForm.value);
            num += 500;

            totalAmountInputForm.value = num;
            display_added_price.value = Number(display_added_price.value) + 500;
        },

        subTotalAmount: () => {
            let totalAmountInputForm = document.getElementById('total_amount');
            let display_added_price = document.getElementById('display_added_price');

            if (display_added_price.value === '' || Number(display_added_price.value) <= 0){
                return ;
            } else {
                let num = Number(totalAmountInputForm.value);
                num -= 500;

                totalAmountInputForm.value = num;
                display_added_price.value = Number(display_added_price.value) - 500;
            }
        },

        searchCheckedPlans: () => {
            let totalAmountInputForm = document.getElementById('total_amount');
            let total_price = getTotalPrice();
            let selectablePlans = document.getElementsByClassName('plan_ids');
            let selectedPlans = [];

            for (let i = 0, len = selectablePlans.length; i < len; i++) {
                if (selectablePlans[i].checked) {
                    selectedPlans.push(selectablePlans[i]);
                }
            }

            for(let $i = 0; $i < selectedPlans.length; $i++){
                let selectedPlanQuantitySelectBox = document.getElementById(`plan_quantity_${checkedPlans[$i].id}`);
                selectedPlanQuantitySelectBox.disabled = false;
            };

            totalAmountInputForm.value = Number(total_price);
        },
    }
})()
