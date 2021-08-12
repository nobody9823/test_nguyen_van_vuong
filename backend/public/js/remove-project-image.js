function removeProjectImage(selector) {
    $(selector).click(function () {
        var deleteConfirm = confirm("削除してもよろしいですか？");
        if (deleteConfirm === true) {
            var el = $(this);
            var ImageId = el.attr("id");
            el.append(
                '<meta name="csrf-token" content="' +
                    document.getElementsByName("_token").item(0).value +
                    '">'
            );
            $.ajax({
                url: "/my_project/project/file/" + ImageId,
                type: "POST",
                data: {
                    project_image: ImageId,
                    _method: "DELETE",
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },

                success: function (msg) {
                    if (msg === "success") {
                        alert("削除が成功しました。");
                        el.parents("div.js-image__card").remove();
                    } else {
                        console.log(msg);
                        alert("エラーが起こりました。");
                    }
                },
            }).fail(function () {
                alert("エラーが起こりました。");
            });
        }
    });
}
