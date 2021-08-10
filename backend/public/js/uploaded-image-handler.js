// update-myProjectとpreviewUploadedImageを呼び出してから利用すること
function uploadedImageHandler(input, columnName, projectId) {
    previewUploadedImage(input, columnName);
    const el = new FormData();
    el.append(columnName, input.files[0]);
    updateMyProject.imageInput(
        {
            name: columnName,
            value: el,
        },
        projectId
    );
}
