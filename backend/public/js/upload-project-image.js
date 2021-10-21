function uploadProjectImage(input, projectId, projectFileId) {
    const formData = new FormData();
    formData.append("file", input.files[0]);

    if (projectFileId) {
        axios
            .post(
                `/my_project/project/${projectId}/uploadProjectImage/${projectFileId}?current_tab=visual`,
                formData
            )
            .then((res) => {
                console.log(res);
                location.replace(res.data.redirect_url);
            })
            .catch((err) => {
                if (err.response.status == 419) {
                    location.reload();
                }
                alert(err.response.data.errors.file);
            });
    } else {
        axios
            .post(
                `/my_project/project/${projectId}/uploadProjectImage?current_tab=visual`,
                formData
            )
            .then((res) => {
                console.log(res);
                location.replace(res.data.redirect_url);
            })
            .catch((err) => {
                if (err.response.status == 419) {
                    location.reload();
                }
                alert(err.response.data.errors.file);
            });
    }
}
