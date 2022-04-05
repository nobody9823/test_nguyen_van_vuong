const updateMyReturn = (() => {
    return {
        copyReturns: (el, projectId, checkedReturns) => {
          axios.post(`/my_project/copyReturn/${projectId}`, checkedReturns)
              .then(res => {
                  location.replace(res.data.redirect_url);
              }).catch((err) => {
                  console.log(err.response);
                  if (err.response.status == 419) {
                      location.reload();
                  }
              });
        }
    }
})();
