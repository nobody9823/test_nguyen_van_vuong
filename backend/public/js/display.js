const display = (() => {
    return {
        planDetail: (paymentId) => {
            const el = document.getElementById(
                "display_plan_detail_" + paymentId
            );

            if (el.style.display === "none") {
                el.style.display = "";
            } else {
                el.style.display = "none";
            }
        },
    };
})();
