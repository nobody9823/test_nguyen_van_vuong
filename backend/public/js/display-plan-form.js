const DisplayPlanForm = () => {
    let el = document.getElementById("plan_form_section");
    if (el.style.display === "none") {
        el.style.display = "block";
    } else {
        el.style.display = "none";
    }
};
