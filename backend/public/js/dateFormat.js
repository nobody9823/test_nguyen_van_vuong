const date = new Date();
// Dateオブジェクトはミュータブルなので、日付がどんどん加算される点に注意
const startDate = date.setDate(date.getDate() + 1);
const endDate = date.setDate(date.getDate() + 50);

const config = {
    dateFormat: "Y-m-d H:i",
    minDate: startDate,
    maxDate: endDate,
    enableTime: true,
    "locale": "ja",
};
flatpickr("#start_date", config);

flatpickr("#end_date", config);

flatpickr("#birthday", {
    dateFormat: "Y-m-d",
    "locale": "ja",
});

flatpickr(".delivery_date", {
    dateFormat: "Y-m-d",
    "locale": "ja",
});