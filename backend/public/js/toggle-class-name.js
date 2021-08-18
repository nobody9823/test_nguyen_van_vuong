// tabで表示の切り替えをするjs
//複数個タブがあって、常にひとつしか選択されない状況の際に利用
// 全て一旦クラス外してから、該当部分だけクラス付与
function toggleClassName(className, targetsSelector, targetElement) {
    let elements = document.querySelectorAll(targetsSelector);
    elements.forEach((element) => element.classList.remove(className));
    targetElement.classList.add(className);
}
