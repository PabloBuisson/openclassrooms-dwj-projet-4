$(document).ready(function () {
    $('#after-email.success').modal('toggle');
    $('#after-email .close, #after-email .close-button').click(function (e) { 
    $('#after-email').removeClass('success');
    });
});