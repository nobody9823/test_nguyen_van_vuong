const openPlanFormModal = (planId) => {
    let openModal = document.getElementById(`plan_form_modal_${planId}`);
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeIn(openModal, 300);
}

const closePlanFormModal = (planId) => {
    let closeModal = document.getElementById(`plan_form_modal_${planId}`);
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeOut(closeModal, 300);
}

const openNewPlanFormModal = () => {
    let openModal = document.getElementById('new_plan_form_modal');
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeIn(openModal, 300);
}

const closeNewPlanFormModal = () => {
    let closeModal = document.getElementById('new_plan_form_modal');
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeOut(closeModal, 300);
}

const createNewPlanAndOpenModal = (projectId) => {
    axios.get(`/my_project/project/${projectId}/createReturn`).then(res => {
        if (res.status === 200){
            document.getElementById('new_plan_id').value = res.data.id;
            openNewPlanFormModal();
        }
    }).catch(res => {
        console.log(res);
    });
}
