jQuery( function ($) {
    $('a').css('pointer-events', 'none');
    $('button').css('pointer-events', 'none');
    $('input').css('pointer-events', 'none');
    $('img').css('pointer-events', 'none');
    $('h2').css('pointer-events', 'none');
    $('div').css('pointer-events', 'none');
    $('.able_to_click').css('pointer-events', 'auto');
    $('.able_to_click_children').contents().css('pointer-events', 'auto');
    $('.able_to_click_children').find('a').css('pointer-events', 'auto');
});
