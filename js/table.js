$(document).ready(function(){
    $('td#tt-due').each(function(){
        var cell_date = Date.parse($(this).text().replace(/(\d{2})\/(\d{2})\/(\d{4})/, '$2/$1/$3'));
        var now_date = Math.round(new Date().getTime());
        if (cell_date < now_date) {
            $(this).css('background-color','#f00');
        }
    });

    $('td#tt-status').each(function() {
        if ($(this).text() == 'Completed') {
            $(this).prev().prev().css('background-color','#60adb6');
        }
    });
});