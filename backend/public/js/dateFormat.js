const date = new Date();
const startDate = date.setDate(date.getDate() + 1);

const config = {
    dateFormat: "Y-m-d H:i",
    minDate: startDate,
    enableTime: true,
    "locale": "ja",
};

const startDateElement = document.getElementById('start_date');
const getValueStartDate = () => {
    const dateData = new Date(startDateElement.value);
    config['maxDate'] = dateData.setDate(dateData.getDate() + 50);
    flatpickr("#end_date", config);
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