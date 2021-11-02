const date = new Date();
const dateLowerLimit = date.setDate(date.getDate() + 1);

const config = {
    dateFormat: "Y-m-d H:i",
    minDate: dateLowerLimit,
    enableTime: true,
    "locale": "ja",
};

const variableEndDate = () => {
    const startDateElement = document.getElementById('start_date');
    const startDate = new Date(startDateElement.value);
    config['maxDate'] = startDate.setDate(startDate.getDate() + 49);
    flatpickr("#end_date", config);
    startDate.setDate(startDate.getDate() - 49);
}
window.onload = () => {
    variableEndDate();
};
const onInputStartDate = () => {
    variableEndDate();
};


flatpickr("#start_date", config);

flatpickr("#birthday", {
    dateFormat: "Y-m-d",
    "locale": "ja",
});

flatpickr(".delivery_date", {
    dateFormat: "Y-m-d",
    "locale": "ja",
});