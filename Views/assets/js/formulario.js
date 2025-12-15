(function () {


    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');

    if (!registerForm && !loginForm) return;


    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function setError(el, msg) {
        if (el) el.textContent = msg || '';
    }

 
    function validateRegister(form) {
        let valid = true;

        const name = form.querySelector('#name');
        const email = form.querySelector('#email');
        const phone = form.querySelector('#phone');
        const password = form.querySelector('#password');
        const confirm = form.querySelector('#confirm');
        const terms = form.querySelector('#terms');

        const errName = document.getElementById('error-name');
        const errEmail = document.getElementById('error-email');
        const errPhone = document.getElementById('error-phone');
        const errPassword = document.getElementById('error-password');
        const errConfirm = document.getElementById('error-confirm');
        const errTerms = document.getElementById('error-terms');

        if (!name.value.trim() || name.value.length < 2) {
            setError(errName, 'Ingresa un nombre válido.');
            valid = false;
        } else setError(errName);

        if (!emailRegex.test(email.value)) {
            setError(errEmail, 'Correo inválido.');
            valid = false;
        } else setError(errEmail);

        if (phone && phone.value && !/^[0-9\-\+\s]{6,20}$/.test(phone.value)) {
            setError(errPhone, 'Teléfono inválido.');
            valid = false;
        } else setError(errPhone);

        if (password.value.length < 8) {
            setError(errPassword, 'Mínimo 8 caracteres.');
            valid = false;
        } else setError(errPassword);

        if (confirm.value !== password.value) {
            setError(errConfirm, 'Las contraseñas no coinciden.');
            valid = false;
        } else setError(errConfirm);

        if (!terms.checked) {
            setError(errTerms, 'Debes aceptar los términos.');
            valid = false;
        } else setError(errTerms);

        return valid;
    }


    function validateLogin(form) {
        let valid = true;

        const email = form.querySelector('#email');
        const password = form.querySelector('#password');

        const errEmail = document.getElementById('error-email');
        const errPassword = document.getElementById('error-password');

        if (!emailRegex.test(email.value)) {
            setError(errEmail, 'Correo inválido.');
            valid = false;
        } else setError(errEmail);

        if (!password.value) {
            setError(errPassword, 'La contraseña es obligatoria.');
            valid = false;
        } else setError(errPassword);

        return valid;
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            if (!validateRegister(registerForm)) {
                e.preventDefault();
            }
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            if (!validateLogin(loginForm)) {
                e.preventDefault();
            }
        });
    }

})();
