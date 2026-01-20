document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal-block').forEach(block => {
        observer.observe(block);
    });

    const phoneInput = document.getElementById('servicePhone');
    if (phoneInput && window.IMask) {
        IMask(phoneInput, {
            mask: '+{7} (000) 000-00-00'
        });
    }

    const track = document.getElementById('partnersTrack');
    if (track) {
        const items = track.querySelectorAll('.partner-item');
        const btnPrev = document.querySelector('.p-prev');
        const btnNext = document.querySelector('.p-next');
        let currentIndex = 0;
        let autoPlayInterval;

        const getItemsPerView = () => {
            const width = window.innerWidth;
            if (width <= 500) return 1;
            if (width <= 800) return 2;
            if (width <= 1200) return 3;
            return 4;
        };

        const updateSlider = () => {
            const itemsPerView = getItemsPerView();
            const totalItems = items.length;

            if (currentIndex > totalItems - itemsPerView) {
                currentIndex = 0;
            }
            if (currentIndex < 0) {
                currentIndex = totalItems - itemsPerView;
            }

            const itemWidth = track.scrollWidth / totalItems;
            const moveAmount = currentIndex * itemWidth;
            
            track.style.transform = `translateX(-${moveAmount}px)`;

            items.forEach(item => item.classList.remove('active-slide'));
            
            for (let i = 0; i < itemsPerView; i++) {
                const targetIndex = currentIndex + i;
                if (items[targetIndex]) {
                    setTimeout(() => {
                        items[targetIndex].classList.add('active-slide');
                    }, i * 150);
                }
            }
        };

        const nextSlide = () => {
            currentIndex++;
            updateSlider();
            resetTimer();
        };

        const prevSlide = () => {
            currentIndex--;
            updateSlider();
            resetTimer();
        };

        if (btnNext) btnNext.addEventListener('click', nextSlide);
        if (btnPrev) btnPrev.addEventListener('click', prevSlide);

        const startTimer = () => {
            autoPlayInterval = setInterval(nextSlide, 5000);
        };

        const resetTimer = () => {
            clearInterval(autoPlayInterval);
            startTimer();
        };

        updateSlider();
        startTimer();

        window.addEventListener('resize', () => {
            updateSlider();
        });
    }

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.textContent;
            
            btn.disabled = true;
            btn.textContent = 'Отправка...';

            const formData = new FormData(form);
            
            try {
                const response = await fetch('send.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.status === 'success') {
                    showToast('Заявка успешно отправлена!', 'success');
                    form.reset();
                } else {
                    showToast('Ошибка отправки. Попробуйте позже.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Ошибка соединения с сервером', 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        });
    });
});

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = type === 'success' 
        ? '<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>'
        : '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';

    toast.innerHTML = `
        <div style="display:flex; align-items:center; gap:10px;">
            ${icon}
            <span>${message}</span>
        </div>
    `;
    
    container.appendChild(toast);
    
    requestAnimationFrame(() => {
        toast.classList.add('show');
    });

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 400);
    }, 4000);
}