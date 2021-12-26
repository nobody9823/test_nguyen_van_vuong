const openSupporterModal = (paymentId) => {
    let openModal = document.getElementById(`supporter_modal_${paymentId}`);
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeIn(openModal, 300);
}

const closeSupporterModal = (paymentId) => {
    let closeModal = document.getElementById(`supporter_modal_${paymentId}`);
    // fade-element.jsを読み込んだ後
    // 第一引数に要素、第二引数にアニメーションの速度
    fadeOut(closeModal, 300);
}
