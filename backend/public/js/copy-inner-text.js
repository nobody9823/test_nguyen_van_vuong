function copyInnerText(targetElement) {
    var text = targetElement.innerText;
    navigator.clipboard.writeText(text);
}
