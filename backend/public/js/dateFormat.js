const dateLowerLimit = new Date();
dateLowerLimit.setDate(dateLowerLimit.getDate() + 1);
dateLowerLimit.setHours(12);
dateLowerLimit.setMinutes(0);
dateLowerLimit.setSeconds(0);
dateLowerLimit.setMilliseconds(0);

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
