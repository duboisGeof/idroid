$(document).ready(function() {

    $(".close").click(function () {
        document.cookie = 'text_cookies=1';
    });

    if (document.cookie.indexOf('text_cookies=') >= 0) {
        $('.text_cookies').hide();
    }
});