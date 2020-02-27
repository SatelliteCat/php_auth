const validateForm = {
    name: {
        required: 'empty_name',
        wrong: 'error_name'
    },
    email: {
        required: 'empty_email',
        wrong: 'error_email'
    },
    phone: {
        required: 'empty_phone',
        wrong: 'error_phone'
    },
    password: {
        required: 'empty_password',
        len: 'error_password',
        confirm: 'error_password_conf'
    },
    image: {
        required: 'empty_image',
        type: 'error_image_type',
        size: 'error_image_size'
    }
};

const regexLang = /hl=\w{2}/i;
const regexName = /^([a-zа-яё_\-0-9]+\s?)+$/i;
const regexPhone = /^\+\d{4,20}$/i;
const regexEmail = /^([\w\._]+)@([\wа-яё\._]+)\.([a-zрф]{2,6})$/ui;
const imageTypes = ['image/jpeg', 'image/png', 'image/gif'];

const validateLoginForm = function (loginForm) {
    let fields = [];

    if (loginForm.get('phone') === '') {
        fields.push({
            field: 'phone',
            type: validateForm.phone.required
        });
    }

    if (!regexPhone.exec(loginForm.get('phone'))) {
        fields.push({
            field: 'phone',
            type: validateForm.phone.wrong
        });
    }

    if (loginForm.get('password') === '') {
        fields.push({
            field: 'password',
            type: validateForm.password.required
        });
    }

    if (loginForm.get('password').toString().length < 6 || loginForm.get('password').toString().length > 30) {
        fields.push({
            field: 'password',
            type: validateForm.password.len
        });
    }

    return fields;
};

const validateRegisterForm = function (registerForm) {
    let fields = validateLoginForm(registerForm);

    if (registerForm.get('name') === '') {
        fields.push({
            field: 'name',
            type: validateForm.name.required
        });
    }

    if (!regexName.exec(registerForm.get('name'))) {
        fields.push({
            field: 'name',
            type: validateForm.name.wrong
        });
    }

    if (registerForm.get('email') === '') {
        fields.push({
            field: 'email',
            type: validateForm.email.required
        });
    }

    if (!regexEmail.exec(registerForm.get('email'))) {
        fields.push({
            field: 'email',
            type: validateForm.email.wrong
        });
    }

    if (registerForm.get('password') !== '' && registerForm.get('password') !== registerForm.get('password_confirm')) {
        fields.push({
            field: 'password',
            type: validateForm.password.confirm
        });
    }

    if (typeof registerForm.get('image') !== "object") {
        fields.push({
            field: 'image',
            type: validateForm.image.required
        });
    }

    if (!imageTypes.includes(registerForm.get('image').type)) {
        fields.push({
            field: 'image',
            type: validateForm.image.type
        });
    }

    if (registerForm.get('image').size > 10000000) {
        fields.push({
            field: 'image',
            type: validateForm.image.size
        });
    }

    return fields;
};

const showErrors = function (fields, source) {
    fields.forEach(function (field) {
        $(`input[name="${field.field}"]`).addClass('error');
    });

    let lang = navigator.language.substr(0, 2);
    if (window.location.search !== '') {
        const langSearch = regexLang.exec(window.location.search)[0].split('=')[1];
        if (source.hasOwnProperty(langSearch)) {
            lang = langSearch;
        }
    }

    $('.msg').text(source[lang][fields[0]['type']]);
};

export {validateRegisterForm, validateLoginForm, showErrors}