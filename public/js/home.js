$(document).ready(function () {

    $('#home-to-project').click(function (e) { 

        $('html, body').animate({
            scrollTop: $('#home-project-alaska').offset().top
        }, 1000);
        
    });
});