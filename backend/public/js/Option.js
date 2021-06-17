var clone_count = 1;

$('.addOptionButton').on('click', function () {
    var new_options = $(this).parent();
    var exists_options = $('#exists_option_form_box');
    if (new_options.parent().children().length + exists_options.children().length < 10) {
        var cloned_option = new_options.clone(true).insertAfter(new_options);
        cloned_option.find('input[type=text]').attr('name', 'options[' + clone_count + '][name]');
        cloned_option.find('input[type=number]').attr('name', 'options[' + clone_count + '][quantity]');
        clone_count += 1;
    }
});

$('.deleteOptionButton').on('click', function () {
    var new_options = $(this).parent();
    if (new_options.parent().children().length > 1) {
        new_options.remove();
    }
});

function ExistsOptionDelete (Guard) {
    $('.deleteExistsOption').on('click', function () {
        $(this).attr('disabled',true);
        var optionId = $(this).attr('id').replace('option_', '');

        $.ajax({
            url: '/' + Guard + '/plan/option/' + optionId,
            type: 'POST',
            data: { 'id': optionId, '_method': 'DELETE' },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(msg){
                if (msg === "success"){
                    location.reload();
                } else {
                    alert("オプションの削除に失敗しました。");
                    location.reload();
                }
            }
        })
        .fail(function() {
            alert("オプションの削除に失敗しました。");
            location.reload();
        });
    });
}
