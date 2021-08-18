// 第一引数に要素、第二引数にアニメーションの速度
const fadeIn = (node, duration) => {
    // display: noneでないときは何もしない
    if (getComputedStyle(node).display !== 'none') return;

    // style属性にdisplay: noneが設定されていたとき
    if (node.style.display === 'none') {
        node.style.display = '';
    } else {
        node.style.display = 'block';
    }
    node.style.opacity = 0;

    let start = performance.now();

    requestAnimationFrame(function tick(timestamp) {
        // イージング計算式（linear）
        let easing = (timestamp - start) / duration;

        // opacityが1を超えないように
        node.style.opacity = Math.min(easing, 1);

        // opacityが1より小さいとき
        if (easing < 1) {
        requestAnimationFrame(tick);
        } else {
        node.style.opacity = '';
        }
    });
}

// 第一引数に要素、第二引数にアニメーションの速度
const fadeOut = (node, duration) => {
    node.style.opacity = 1;

    let start = performance.now();

    requestAnimationFrame(function tick(timestamp) {
        // イージング計算式（linear）
        let easing = (timestamp - start) / duration;

        // opacityが0より小さくならないように
        node.style.opacity = Math.max(1 - easing, 0);

        // イージング計算式の値が1より小さいとき
        if (easing < 1) {
        requestAnimationFrame(tick);
        } else {
        node.style.opacity = '';
        node.style.display = 'none';
        }
    });
}
