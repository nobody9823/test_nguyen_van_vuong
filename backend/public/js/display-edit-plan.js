const DisplayEditPlan = (planId) => {
    let PlanFormSections = document.querySelectorAll(
        ".edit_plan_form_sections"
    );
    for (let $i = 0; $i < PlanFormSections.length; $i++) {
        PlanFormSections[$i].style.display = "none";
    }
    document.getElementById("edit_plan_form_section_" + planId).style.display =
        "block";
};
