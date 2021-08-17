const selectedRadioButtonHandler = () => {
    let tagId = document.querySelector("input[name='tag_id']:checked")?.value;
    let sortType = document.querySelector("input[name='sort_type']:checked")?.value;
    window.location.replace(`?tag_id=${tagId}&sort_type=${sortType}`);
};
