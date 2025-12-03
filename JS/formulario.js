    
    (function () {
        
        const form = document.getElementById('register-form');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm');
        const termsInput = document.getElementById('terms');
        const btn = document.getElementById('btn-register');
        const msg = document.getElementById('form-msg');
        const pwBar = document.getElementById('pw-bar');

       
        const errName = document.getElementById('error-name');
        const errEmail = document.getElementById('error-email');
        const errPhone = document.getElementById('error-phone');
        const errPassword = document.getElementById('error-password');
        const errConfirm = document.getElementById('error-confirm');
        const errTerms = document.getElementById('error-terms');

   
        const usersList = document.getElementById('users-list');

      
        function loadUsers() {
            try {
                const raw = localStorage.getItem('delfin_users');
                return raw ? JSON.parse(raw) : [];
            } catch (e) {
                return [];
            }
        }
        function saveUsers(users) {
            localStorage.setItem('delfin_users', JSON.stringify(users));
        }

        function renderUsers() {
            const users = loadUsers();
            usersList.innerHTML = users.length ? users.map(u => '<li>' + escapeHtml(u.name) + ' — ' + escapeHtml(u.email) + '</li>').join('') : '<li class="muted">No hay usuarios registrados.</li>';
        }

        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, function(m){ return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]; });
        }

      
        function validateName() {
            const v = nameInput.value.trim();
            if (!v) { errName.textContent = 'El nombre es obligatorio.'; return false; }
            if (v.length < 2) { errName.textContent = 'Ingresa al menos 2 caracteres.'; return false; }
            errName.textContent = '';
            return true;
        }

        function validateEmail() {
            const v = emailInput.value.trim().toLowerCase();
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!v) { errEmail.textContent = 'El correo es obligatorio.'; return false; }
            if (!re.test(v)) { errEmail.textContent = 'Formato de correo inválido.'; return false; }
          
            const users = loadUsers();
            const exists = users.some(u => u.email.toLowerCase() === v);
            if (exists) { errEmail.textContent = 'Este correo ya está registrado.'; return false; }
            errEmail.textContent = '';
            return true;
        }

        function validatePhone() {
            const v = phoneInput.value.trim();
            if (!v) { errPhone.textContent = ''; return true; } 
            const re = /^[0-9\-\+\s]{6,20}$/;
            if (!re.test(v)) { errPhone.textContent = 'Teléfono inválido.'; return false; }
            errPhone.textContent = '';
            return true;
        }

        function passwordStrength(pw) {
            let score = 0;
            if (pw.length >= 8) score += 1;
            if (/[a-z]/.test(pw)) score += 1;
            if (/[A-Z]/.test(pw)) score += 1;
            if (/[0-9]/.test(pw)) score += 1;
            if (/[\W_]/.test(pw)) score += 1;
            return score;
        }

        function validatePassword() {
            const v = passwordInput.value;
            if (!v) { errPassword.textContent = 'La contraseña es obligatoria.'; updatePwBar(0); return false; }
            const score = passwordStrength(v);
            updatePwBar(score);
            if (v.length < 8) { errPassword.textContent = 'La contraseña debe tener al menos 8 caracteres.'; return false; }
            if (!/[A-Z]/.test(v)) { errPassword.textContent = 'Incluye al menos una letra mayúscula.'; return false; }
            if (!/[a-z]/.test(v)) { errPassword.textContent = 'Incluye al menos una letra minúscula.'; return false; }
            if (!/[0-9]/.test(v)) { errPassword.textContent = 'Incluye al menos un número.'; return false; }
            errPassword.textContent = '';
            return true;
        }

        function validateConfirm() {
            if (!confirmInput.value) { errConfirm.textContent = 'Confirma la contraseña.'; return false; }
            if (confirmInput.value !== passwordInput.value) { errConfirm.textContent = 'Las contraseñas no coinciden.'; return false; }
            errConfirm.textContent = '';
            return true;
        }

        function validateTerms() {
            if (!termsInput.checked) { errTerms.textContent = 'Debes aceptar los términos.'; return false; }
            errTerms.textContent = '';
            return true;
        }

        function updatePwBar(score) {
            const percent = Math.min(100, (score / 5) * 100);
            pwBar.style.width = percent + '%';
          
            if (score <= 1) pwBar.style.background = '#f44336';
            else if (score <= 3) pwBar.style.background = '#f4d35e';
            else pwBar.style.background = 'linear-gradient(90deg,var(--dorado),var(--coral))';
        }

        nameInput.addEventListener('input', validateName);
        emailInput.addEventListener('input', () => { errEmail.textContent=''; });
        emailInput.addEventListener('blur', validateEmail);
        phoneInput.addEventListener('input', validatePhone);
        passwordInput.addEventListener('input', validatePassword);
        confirmInput.addEventListener('input', validateConfirm);
        termsInput.addEventListener('change', validateTerms);

        
        form.addEventListener('submit', function (e) {
            e.preventDefault();
         
            msg.textContent = ''; msg.className = '';

            const okName = validateName();
            const okEmail = validateEmail();
            const okPhone = validatePhone();
            const okPassword = validatePassword();
            const okConfirm = validateConfirm();
            const okTerms = validateTerms();

            if (!(okName && okEmail && okPhone && okPassword && okConfirm && okTerms)) {
                msg.textContent = 'Corrige los errores en el formulario.';
                msg.className = 'error';
                return;
            }

        
            const user = {
                id: Date.now(),
                name: nameInput.value.trim(),
                email: emailInput.value.trim().toLowerCase(),
                phone: phoneInput.value.trim() || null,
                birth: document.getElementById('birth').value || null,
                createdAt: new Date().toISOString()
            };

        
            btn.disabled = true;
            btn.textContent = 'Registrando...';

        
            setTimeout(() => {
                const users = loadUsers();
               
                if (users.some(u => u.email === user.email)) {
                    errEmail.textContent = 'Este correo ya se registró (otro proceso).';
                    msg.textContent = 'No se pudo completar el registro.';
                    msg.className = 'error';
                    btn.disabled = false;
                    btn.textContent = 'Registrarse';
                    return;
                }
                users.push(user);
                saveUsers(users);

              
                form.reset();
                updatePwBar(0);
                renderUsers();

                msg.textContent = 'Registro exitoso. ¡Bienvenido/a, ' + (user.name.split(' ')[0] || user.name) + '!';
                msg.className = 'success';

                btn.disabled = false;
                btn.textContent = 'Registrarse';
            }, 700); 

        });

        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    window.scrollTo({ top: target.offsetTop - 20, behavior: 'smooth' });
                }
            });
        });
    })();
    