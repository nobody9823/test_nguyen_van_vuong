const config = {
    dateFormat: "Y-m-d H:i",
    enableTime: true,
    "locale": "ja",
};
flatpickr("#start_date", config);

flatpickr("#end_date", config);

flatpickr(".delivery_date", {
    dateFormat: "Y-m-d",
    "locale": "ja",
});
