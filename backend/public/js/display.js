const display = (() => {

    return {
        planDetail: paymentId => {

            const el = document.getElementById('display_plan_detail_' + paymentId);

            if (el.style.display === 'none'){
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        }
    }
})();