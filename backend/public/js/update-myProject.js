const updateMyProject = (() => {

    var Timer = null;

    var data = {};

    var savedTimer = null;

    const displayIcon = (el) => {
        el.style.display = 'contents';
        setTimeout(() => { dissaperIcon(el); }, 3000);
    }

    const dissaperIcon = (el) => {
        el.style.display = 'none';
        clearTimeout(savedTimer);
    }

    const uploadProject = (el, projectId) => {

        data[el.name] = el.value;

        document.getElementById('spinner_' + el.name).style.display = 'block';

        axios.post(`/my_project/uploadProject/${projectId}`, data).then(res => {
            if(res.data.result === true){
                document.getElementById('spinner_' + el.name).style.display = 'none';
                displayIcon(document.getElementById('saved_' + el.name));
            }
        }).catch(res => {
            console.log(res);
        });
    }

    return {
        textInput: (el, projectId) => {
            if (Timer) {clearTimeout(Timer);}
            Timer = setTimeout(() => {uploadProject(el, projectId);}, 1000)
        }
    }
})();