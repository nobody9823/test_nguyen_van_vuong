// update-myProjectとpreviewUploadedImageを呼び出してから利用すること
function uploadedImageHandler(input, columnName, projectId) {
    const result = previewUploadedImage(input, columnName);
    if (result !== false){
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
}
