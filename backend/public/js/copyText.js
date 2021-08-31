const copyText = (() => {

    return {
        copy:  (el, elementId) => {

            document.getElementById(elementId).style.display = 'block';

            const copyFrom = document.createElement("textarea");

            copyFrom.textContent = el.innerText;

            const bodyElm = document.getElementsByTagName("body")[0];

            bodyElm.appendChild(copyFrom);

            copyFrom.select();

            const retVal = document.execCommand('copy');

            bodyElm.removeChild(copyFrom);

            return retVal;
        }
    }
})();