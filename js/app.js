document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-block, .feat-card').forEach(block => observer.observe(block));

    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(input => { if (window.IMask) IMask(input, { mask: '+{7} (000) 000-00-00' }); });

    const track = document.getElementById('partnersTrack');
    if (track) {
        const items = track.querySelectorAll('.partner-item');
        const btnPrev = document.querySelector('.p-prev');
        const btnNext = document.querySelector('.p-next');
        let currentIndex = 0;
        let autoPlayInterval;
        const getItemsPerView = () => window.innerWidth <= 500 ? 1 : window.innerWidth <= 800 ? 2 : window.innerWidth <= 1200 ? 3 : 4;
        const updateSlider = () => {
            const itemsPerView = getItemsPerView();
            const totalItems = items.length;
            if (currentIndex > totalItems - itemsPerView) currentIndex = 0;
            if (currentIndex < 0) currentIndex = totalItems - itemsPerView;
            const itemWidth = track.scrollWidth / totalItems;
            track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
            items.forEach(item => item.classList.remove('active-slide'));
            for (let i = 0; i < itemsPerView; i++) if (items[currentIndex + i]) setTimeout(() => items[currentIndex + i].classList.add('active-slide'), i * 150);
        };
        const nextSlide = () => { currentIndex++; updateSlider(); resetTimer(); };
        const prevSlide = () => { currentIndex--; updateSlider(); resetTimer(); };
        if (btnNext) btnNext.addEventListener('click', nextSlide);
        if (btnPrev) btnPrev.addEventListener('click', prevSlide);
        const startTimer = () => autoPlayInterval = setInterval(nextSlide, 5000);
        const resetTimer = () => { clearInterval(autoPlayInterval); startTimer(); };
        updateSlider(); startTimer();
        window.addEventListener('resize', () => updateSlider());
    }

    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filterValue = btn.getAttribute('data-filter');
                galleryItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-cat') === filterValue) {
                        item.classList.remove('hidden');
                        item.style.animation = 'fadeIn 0.5s ease forwards';
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });
    }

    function validateField(input) {
        const group = input.closest('.form-group');
        const name = input.name;
        const value = input.value.trim();
        let isValid = false;
        group.classList.remove('valid', 'invalid');
        if (name === 'name') {
            const nameRegex = /^[a-zA-Zа-яА-ЯёЁ\s\-]+$/;
            isValid = value.length >= 2 && nameRegex.test(value);
        } else if (name === 'phone') {
            const digits = value.replace(/\D/g, '');
            isValid = digits.length === 11;
        } else if (name === 'email') {
            if (value === '') { isValid = true; group.classList.remove('valid'); return true; }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isValid = emailRegex.test(value);
        }
        if (isValid) group.classList.add('valid'); else group.classList.add('invalid');
        return isValid;
    }

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('blur', () => { if (input.value.length > 0) validateField(input); });
            input.addEventListener('input', () => input.closest('.form-group').classList.remove('invalid'));
        });
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            let formIsValid = true;
            inputs.forEach(input => { if (input.name === 'name' || input.name === 'phone') if (!validateField(input)) formIsValid = false; });
            if (!formIsValid) { showToast('Заполните корректно выделенные поля!', 'error'); return; }
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Отправка...';
            const formData = new FormData(form);
            try {
                const response = await fetch('send.php', { method: 'POST', body: formData });
                const result = await response.json();
                if (result.status === 'success') {
                    showToast('Заявка успешно отправлена!', 'success');
                    form.reset();
                    inputs.forEach(i => i.closest('.form-group').classList.remove('valid'));
                } else { showToast(result.message || 'Ошибка отправки.', 'error'); }
            } catch (error) { console.error(error); showToast('Ошибка соединения с сервером', 'error'); } finally { btn.disabled = false; btn.textContent = originalText; }
        });
    });
});

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    const icon = type === 'success' ? '<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>' : '<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
    toast.innerHTML = `<div style="display:flex; align-items:center; gap:10px;">${icon}<span>${message}</span></div>`;
    container.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));
    setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 400); }, 4000);
}