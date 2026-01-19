document.addEventListener('DOMContentLoaded', () => {
    
    if (window.appInitialized) return;
    window.appInitialized = true;

    // --- АНИМАЦИЯ ПРИ СКРОЛЛЕ (SCROLL REVEAL) ---
    const animatedElements = document.querySelectorAll('.contact-card, .section-header, .srv-card, .step-card, .hero-title-large, .feature-item, .price-table-wrapper');
    
    const observerOptions = {
        threshold: 0.1, // Срабатывает, когда 10% элемента видно
        rootMargin: '0px 0px -50px 0px' // Чуть раньше, чем низ экрана
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Анимация только один раз
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        el.classList.add('reveal-block'); // Добавляем класс скрытия
        observer.observe(el); // Начинаем следить
    });

    // --- МЕНЮ И ШАПКА ---
    try {
        const menuBtn = document.getElementById('menuBtn');
        const headerNav = document.getElementById('headerNav');
        const header = document.querySelector('.header');

        if (menuBtn && headerNav) {
            menuBtn.addEventListener('click', () => {
                headerNav.classList.toggle('active');
                menuBtn.style.transform = headerNav.classList.contains('active') ? 'rotate(90deg)' : 'rotate(0deg)';
            });
            headerNav.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    headerNav.classList.remove('active');
                    menuBtn.style.transform = 'rotate(0deg)';
                });
            });
        }

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.style.background = 'rgba(0, 0, 0, 0.98)';
                header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.5)';
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.95)';
                header.style.boxShadow = '0 1px 10px rgba(46, 204, 113, 0.3)';
            }
        });
    } catch (e) {}

    // --- ФОРМЫ ---
    function setupForm(formId, phoneId) {
        const form = document.getElementById(formId);
        if (!form) return;

        const phoneInput = document.getElementById(phoneId);
        let phoneMask = null;
        let isSubmitting = false;

        if (phoneInput && typeof IMask !== 'undefined') {
            phoneMask = IMask(phoneInput, { mask: '+{7} (000) 000-00-00' });
        }

        function validateInput(input) {
            const type = input.name;
            const parent = input.closest('.form-group');
            let valid = false;

            if (type === 'name') {
                valid = input.value.trim().length >= 2;
            } else if (type === 'phone') {
                valid = phoneMask && phoneMask.unmaskedValue.length === 11;
            } else if (type === 'email') {
                if (input.value.trim() === '') {
                    valid = true;
                    parent.classList.remove('valid', 'invalid');
                    return true;
                }
                const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                valid = re.test(input.value);
            } else if (type === 'message') {
                valid = input.value.trim().length >= 5;
            } else {
                valid = true;
            }

            if (valid) {
                parent.classList.add('valid');
                parent.classList.remove('invalid');
            } else {
                parent.classList.add('invalid');
                parent.classList.remove('valid');
            }
            return valid;
        }

        form.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', () => validateInput(el));
            el.addEventListener('blur', () => validateInput(el));
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (isSubmitting) return;

            let hasError = false;
            form.querySelectorAll('input[required], textarea[required]').forEach(el => {
                if (!validateInput(el)) hasError = true;
            });

            if (hasError) {
                showToast('Заполните обязательные поля', 'error');
                form.animate([
                    { transform: 'translateX(0)' }, { transform: 'translateX(-10px)' }, 
                    { transform: 'translateX(10px)' }, { transform: 'translateX(0)' }
                ], { duration: 300 });
                return;
            }

            isSubmitting = true;
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'ОТПРАВЛЯЮ...';
            btn.style.opacity = '0.7';
            btn.disabled = true;

            const formData = new FormData(form);
            if(phoneMask) formData.set('phone', phoneMask.value);

            try {
                const response = await fetch('send.php', { method: 'POST', body: formData });
                const result = await response.json();

                if (result.status === 'success') {
                    showToast('Ваша заявка принята!');
                    form.reset();
                    if(phoneMask) phoneMask.updateValue();
                    form.querySelectorAll('.form-group').forEach(div => div.classList.remove('valid', 'invalid'));
                } else {
                    showToast('Ошибка: ' + result.message, 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Ошибка сети', 'error');
            } finally {
                isSubmitting = false;
                btn.innerText = originalText;
                btn.style.opacity = '1';
                btn.disabled = false;
            }
        });
    }

    setupForm('contactPageForm', 'contactPhone');
    setupForm('serviceForm', 'servicePhone');

    function showToast(text, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = type === 'success' 
            ? `<svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg><span>${text}</span>`
            : `<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg><span>${text}</span>`;
        
        container.appendChild(toast);
        setTimeout(() => toast.classList.add('show'), 10);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
});