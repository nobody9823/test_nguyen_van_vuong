const Plans = (() => {
    return {
        planIsChecked: (el) => {
            let id = el.id

            let selected_amount = document.getElementById('plan_amount_' + id);

            if(selected_amount.disabled){
                selected_amount.disabled = false;
            } else {
                selected_amount.disabled = true;
            }
        },
        searchCheckedPlans: () => {
            let checkboxElements = document.getElementsByClassName("plan_ids");

            let checkedPlans = [];

            for (var i = 0, len = checkboxElements.length; i < len; i++) {
                if (checkboxElements[i].checked) {
                    checkedPlans.push(checkboxElements[i]);
                }
            }

            for($i = 0; $i < checkedPlans.length; $i++){
                checkedPlans[$i].id;
                let selected_amount = document.getElementById('plan_amount_' + checkedPlans[$i].id);
                selected_amount.disabled = false;
            };
        }
    }
})()
