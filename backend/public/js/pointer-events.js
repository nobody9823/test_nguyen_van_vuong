jQuery( function ($) {
    $('a').css('pointer-events', 'none');
    $('button').css('pointer-events', 'none');
    $('input').css('pointer-events', 'none');
    $('img').css('pointer-events', 'none');
    $('h2').css('pointer-events', 'none');
    $('div').css('pointer-events', 'none');
    $('iframe').parent('div').css('pointer-events', 'auto');
    $('.ableToClick').css('pointer-events', 'auto');
});
