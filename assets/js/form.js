import {validateLoginForm, validateRegisterForm, showErrors} from './validate-form.js';
import {source} from './lang.js';

/**
 * Change forms
 */

$('.message a').click(function () {
    $('.msg').hide();
    $('input').removeClass('error');
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});


/**
 * Login
 */

$('.btn-login').click(function (e) {
    e.preventDefault();
    $('input').removeClass('error');

    let formData = new FormData();
    formData.append('phone', $('input[name="phone_log"]').val());
    formData.append('password', $('input[name="password_log"]').val());

    let result = validateLoginForm(formData);

    if (!result.length) {
        $.ajax({
            url: 'vendor/controllers/LoginController.php',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cashe: false,
            data: formData,
            success(data) {
                if (data.status) {
                    document.location.reload();
                } else {
                    const msg = $('.msg');
                    msg.text(data.message);
                    msg.show();
                }
            }
        });
    } else {
        result.forEach(function (errorObj) {
            errorObj.field += '_log';
        });
        showErrors(result, source);
        $('.msg').show();
    }
});


/**
 * Register
 */

let image;
$('input[name="image"]').change(function (e) {
    image = e.target.files[0];
});

$('.btn-reg').click(function (e) {
    e.preventDefault();
    $('input').removeClass('error');

    let formData = new FormData();
    formData.append('name', $('input[name="name"]').val());
    formData.append('phone', $('input[name="phone"]').val());
    formData.append('email', $('input[name="email"]').val());
    formData.append('password', $('input[name="password"]').val());
    formData.append('password_confirm', $('input[name="password_confirm"]').val());
    formData.append('image', image);

    const res = validateRegisterForm(formData);

    if (!res.length) {
        $.ajax({
            url: '../../vendor/controllers/RegisterController.php',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cashe: false,
            data: formData,
            success(data) {
                if (data.status) {
                    document.location.reload();
                } else {
                    const msg = $('.msg');
                    msg.text(data.message);
                    msg.show();
                }
            }
        });
    } else {
        showErrors(res, source);
        $('.msg').show();
    }
});


/**
 * Logout
 */

$('.btn-logout').click(function (e) {
    e.preventDefault();

    $.ajax({
        url: '../../vendor/controllers/LogoutController.php',
        type: 'GET',
        success(data) {
            document.location.reload();
        }
    });
});
