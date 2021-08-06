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

    const displayIcon = (el) => {
        el.style.display = 'contents';
        setTimeout(() => { dissaperIcon(el); }, 3000);
    }

    const dissaperIcon = (el) => {
        el.style.display = 'none';
        clearTimeout(savedTimer);
    }

    const setTimer = (data, projectId) => {
        if (Timer) {clearTimeout(Timer);}
        Timer = setTimeout(() => {uploadProject(data, projectId);}, 1000)
    }

    const uploadProject = (data, projectId) => {
        document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'block';

        axios.post(`/my_project/uploadProject/${projectId}`, data).then(res => {
            if(res.data.result === true){
                document.getElementById('spinner_' + Object.keys(data)[0]).style.display = 'none';
                displayIcon(document.getElementById('saved_' + Object.keys(data)[0]));
            }
        }).catch(res => {
            console.log(res);
        });
    }

    return {
        textInput: (el, projectId) => {
            data = {};
            data[el.name] = el.value;
            setTimer(data, projectId);
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
                    setTimer(data, projectId);
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
                    setTimer(data, projectId);
                }
            };
        },

        inputIsChecked: (el, projectId) => {
            data = {};
            data['tags'] = {};
            for(i = 0; i < el.childNodes.length; i++){
                if (el.childNodes[i].type === 'checkbox' && el.childNodes[i].checked){
                    data['tags'][i] = el.childNodes[i].value;
                }
            }
            setTimer(data, projectId);
        }
    }
})();