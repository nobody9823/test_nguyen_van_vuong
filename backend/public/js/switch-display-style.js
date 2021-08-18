// tabで表示の切り替えをするjs
// 全て一旦消してから、該当部分だけblockにする
// select-edit-tagと類似
function switchDisplayStyle(unvisibleSelector, visibleSelector) {
    let unvisibleElements = document.querySelectorAll(unvisibleSelector);
    let visibleElements = document.querySelectorAll(visibleSelector);
    unvisibleElements.forEach((element) => (element.style.display = "none"));
    visibleElements.forEach((element) => (element.style.display = "block"));
}
