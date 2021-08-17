const updateMyPlan = (() => {

    var Timer = null;

    var data = {};

    var validatedTimer = null;

    var savedTimer = null;

    var deliveryYear = document.getElementById('delivery_year');

    var deliveryMonth = document.getElementById('delivery_month');

    var deliveryDay = document.getElementById('delivery_day');

    const getSpinner = (data, planId) => {
        if (data instanceof FormData){
            return document.getElementById('spinner_return_image_url' + (planId === undefined ? '' : '_' + planId));
        } else {
            return document.getElementById('spinner_return_' + Object.keys(data)[0] + (planId === undefined ? '' : '_' + planId));
        }
    }

    const displayError = (data, message, planId) => {
        const ul = document.createElement('ul');
        message.forEach(e => {
            var childElement = document.createElement('li');
            childElement.innerHTML = e;
            ul.appendChild(childElement);
        });
        document.getElementById('errors_return_' + (Object.keys(data)[0]) + (planId !== undefined ? '_' + planId : '')).appendChild(ul);
        setTimeout(() => { disappearError(data, planId); }, 5000 );
    }

    const disappearError = (data, planId) => {
        document.getElementById('errors_return_' + (Object.keys(data)[0] + (planId !== undefined ? '_' + planId : ''))).innerHTML = "";
    }

    const displayIcon = (data, planId) => {

        var el;

        if (data instanceof FormData){
            el = document.getElementById('saved_return_image_url' + (planId === undefined ? '' : '_' + planId));
        } else {
            el = document.getElementById('saved_return_' + Object.keys(data)[0] + (planId === undefined ? '' : '_' + planId));
        }
        el.style.display = 'contents';
        setTimeout(() => { dissaperIcon(el); }, 3000);
    }

    const dissaperIcon = (el) => {
        el.style.display = 'none';
        clearTimeout(savedTimer);
    }

    const setTimer = (data, projectId, planId) => {
        if (Timer) {clearTimeout(Timer);}
        Timer = setTimeout(() => {uploadPlan(data, projectId, planId);}, 1000)
    }

    const previewUploadedImage = (file, planId) => {

        var preview;

        if (!(preview = document.getElementById('image_url_' + planId))){
            preview = document.getElementById('image_url');
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            const imageUrl = e.target.result; // URLはevent.target.resultで呼び出せる
            const img = document.createElement("img"); // img要素を作成
            img.src = imageUrl; // URLをimg要素にセット
            preview.removeChild(preview.firstElementChild);
            preview.appendChild(img); // #previewの中に追加
        }
        reader.readAsDataURL(file.get('image_url'));
    }

    const uploadPlan = (data, projectId, planId) => {

        var spinner = getSpinner(data, planId);
        spinner.style.display = 'block';

        axios.post(`/my_project/project/${projectId}/updatePlan/${planId === undefined ? document.getElementById('plan_id').value : planId}`, data).then(res => {
            spinner.style.display = 'none';
            if(res.data.result === true){
                if (data instanceof FormData){
                    previewUploadedImage(data, planId);
                }
                displayIcon(data, planId);
            } else if (res.data.message !== undefined){
                console.log(data);
                displayError(data, res.data.message[Object.keys(data)[0]], planId);
            }
        }).catch(res => {
            spinner.style.display = 'none';
            console.log(res);
        });
    }

    return {
        textInput: (el, projectId, planId) => {
            data = {};
            data[el.name] = el.value;
            setTimer(data, projectId, planId);
        },

        checkDateIsFilled: (el, projectId, planId) => {
            if (el.name.indexOf('delivery') !== -1){
                if (deliveryYear.value !== "" && deliveryMonth.value > 0 && deliveryDay.value > 0){
                    data = {};
                    data["delivery_date"] = 'delivery_date';
                    data[deliveryYear.name] = deliveryYear.value;
                    data[deliveryMonth.name] = deliveryMonth.value;
                    data[deliveryDay.name] = deliveryDay.value;
                    setTimer(data, projectId, planId);
                }
            }
        },

        selectorInput: (el, projectId, planId) => {
            data = {};
            data[el.name] = el.value;
            setTimer(data, projectId, planId);
        },

        uploadImage: (el, projectId, planId) => {
            const formData = new FormData();
            formData.append('image_url', el.files[0]);

            setTimer(formData, projectId, planId);
        },

        limitOfSupportersIsChecked: (el, projectId, planId) => {
            data = {};
            data['limit_of_supporters_is_required'] = {};
            if (el.type === 'checkbox' && el.checked){
                data['limit_of_supporters_is_required'] = 1;
                document.getElementById(`limit_of_supporters${planId === undefined ? '' : '_' + planId}`).style.display = 'block';
            } else {
                data['limit_of_supporters_is_required'] = 0;
                document.getElementById(`limit_of_supporters${planId === undefined ? '' : '_' + planId}`).style.display = 'none';
            }
            setTimer(data, projectId, planId);
        },

        deletePlan: (el, projectId, planId) => {
            var spinner = document.getElementById('spinner_return_' + (planId));
            spinner.style.display = 'block';

            axios.delete(`/my_project/project/${projectId}/delete_plan/${planId}`)
                .then(res => {
                    spinner.style.display = 'none';
                    if(res.data.result){
                        el.parentNode.parentNode.remove();
                    };
                }).catch(res =>{
                    console.log(res);
                });
        }
    }
})();
