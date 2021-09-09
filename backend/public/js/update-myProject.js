const updateMyProject = (() => {

    var Timer = null;

    var data = {};

    var savedTimer = null;

    var startYear = document.getElementById('start_year');

    var startMonth = document.getElementById('start_month');

    var startDay = document.getElementById('start_day');

    var startHour = document.getElementById('start_hour');

    var startMinute = document.getElementById('start_minute');

    var endYear = document.getElementById('end_year');

    var endMonth = document.getElementById('end_month');

    var endDay = document.getElementById('end_day');

    var endHour = document.getElementById('end_hour');

    var endMinute = document.getElementById('end_minute');

    var birthYear = document.getElementById('birth_year');

    var birthMonth = document.getElementById('birth_month');

    var birthDay = document.getElementById('birth_day');

    var postal_code = document.getElementById('postal_code');

    var prefecture = document.getElementById('prefecture');

    var city = document.getElementById('city');

    var block = document.getElementById('block');

    const displayIcon = (el) => {
        el.style.display = 'inline-block';
        setTimeout(() => { dissaperIcon(el); }, 3000);
    }

    const dissaperIcon = (el) => {
        el.style.display = 'none';
        clearTimeout(savedTimer);
    }

    const displayError = (e, message) => {
        const ul = document.createElement('ul');
        message.forEach(e => {
            var childElement = document.createElement('li');
            childElement.innerHTML = e;
            ul.appendChild(childElement);
        });
        document.getElementById('errors_' + Object.keys(e)[0]).appendChild(ul);
        setTimeout(() => { disappearError(e); }, 5000 );
    }

    const disappearError = (e) => {
        document.getElementById('errors_' + Object.keys(e)[0]).innerHTML = '';
    }

    const setTimer = (data, projectId, inputType) => {
        if (Timer) {clearTimeout(Timer);}
        if (inputType == 'text') {
            Timer = setTimeout(() => {uploadProject(data, projectId);}, 1000)
        } else if (inputType == 'image') {
            Timer = setTimeout(() => {uploadProjectImage(data, projectId);}, 1000)
        }
    }

    const uploadProject = (data, projectId) => {
        document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'block';

        axios.post(`/my_project/uploadProject/${projectId}`, data).then(res => {
            if(res.data.result === true){
                console.log(res);
                var pastDue = res.data.account.requirements.past_due
                if (pastDue.length) {
                    displayIndividualStatus(pastDue);
                } else {
                    toastr["clear"]();
                    toastr["success"]('本人確認情報の登録完了');
                }

                document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'none';
                displayIcon(document.getElementById('saved_' + Object.keys(data)[0]));
            } else if (res.data.message !== undefined) {
                document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'none';
                displayError(data, res.data.message[Object.keys(data)[0]]);
            } else {
                document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'none';
            }
        }).catch(res => {
            document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'none';
            console.log(res);
        });
    }

    const uploadProjectImage = (data, projectId) => {
        document.getElementById('spinner_' + data.name).style.display = 'block';

        axios.post(`/my_project/uploadProject/${projectId}`, data.value).then(res => {
            if(res.data.result === true){
                document.getElementById('spinner_' + data.name).style.display = 'none';
                displayIcon(document.getElementById('saved_' + data.name));
            }
        }).catch(res => {
            console.log(res);
            document.getElementById('spinner_' + data.name).style.display = 'none';
        });
    }

    return {
        textInput: (el, projectId) => {
            data = {};
            data[el.name] = el.value;
            setTimer(data, projectId, 'text');
        },
        imageInput: (el, projectId) => {
            setTimer(el, projectId, 'image');
        },

        checkDateIsFilled: (el, projectId) => {
            if(el.name.indexOf('start') !== -1){
                if (startYear.value !== "" && startMonth.value !== "" && startDay.value !== "" && startHour.value !== "" && startMinute.value !== "")
                {
                    data = {};
                    data["start_date"] = 'start_date';
                    data[startYear.name] = startYear.value;
                    data[startMonth.name] = startMonth.value;
                    data[startDay.name] = startDay.value;
                    data[startHour.name] = startHour.value;
                    data[startMinute.name] = startMinute.value;
                    setTimer(data, projectId, 'text');
                }
            } else if (el.name.indexOf('end') !== -1){
                if (endYear.value !== "" && endMonth.value !== "" && endDay.value !== "" && endHour.value !== "" && endMinute.value !== "")
                {
                    data = {};
                    data["end_date"] = 'end_date';
                    data[endYear.name] = endYear.value;
                    data[endMonth.name] = endMonth.value;
                    data[endDay.name] = endDay.value;
                    data[endHour.name] = endHour.value;
                    data[endMinute.name] = endMinute.value;
                    setTimer(data, projectId, 'text');
                }
            } else if (el.name.indexOf('birth') !== -1){
                if (birthYear.value !== "" && birthMonth.value !== "" && birthDay.value !== "")
                {
                    data = {};
                    data["birth_date"] = 'birth_date';
                    data[birthYear.name] = birthYear.value;
                    data[birthMonth.name] = birthMonth.value;
                    data[birthDay.name] = birthDay.value;
                    setTimer(data, projectId, 'text');
                }
            } else if (el.name == 'postal_code'){
                if (postal_code.value !== "" && prefecture.value !== "" && city.value !== "" && block.value !== "")
                {
                    data = {};
                    data[postal_code.name] = postal_code.value;
                    data[prefecture.name] = prefecture.value;
                    data[city.name] = city.value;
                    data[block.name] = block.value;
                    setTimer(data, projectId, 'text');
                }
            }
        },

        inputIsChecked: (el, projectId) => {
            data = {};
            data['tags'] = {};
            for(i = 0; i < el.childNodes.length; i++){
                if (el.childNodes[i].type === 'checkbox' && el.childNodes[i].checked){
                    data['tags'][i] = el.childNodes[i].value;
                }
            }
            setTimer(data, projectId, 'text');
        }
    }
})();
