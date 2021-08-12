const selectEditTag = (el) => {
    let myProjectSections = document.querySelectorAll(".my_project_section");
    for (let $i = 0; $i < myProjectSections.length; $i++) {
        myProjectSections[$i].style.display = "none";
    }
    document.getElementById(el.value + "_section").style.display = "block";
};
