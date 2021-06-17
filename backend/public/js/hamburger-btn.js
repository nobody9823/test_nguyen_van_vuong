$(function() {
    $(".hanburger-btn").click( function() {
        if ($("nav.sidebar").hasClass("d-none")) {
            $("nav.sidebar").removeClass("d-none").addClass("d-index");
        } else {
            $("nav.sidebar").removeClass("d-index").addClass("d-none");
        }
    });
});