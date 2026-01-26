<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заявки | RASSVET</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.png" type="image/png">
    <script src="https://unpkg.com/imask"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="checkout-wrapper">
        <div class="container">
            <div class="checkout-grid">
                
                <div class="checkout-form-card">
                    <h1 class="ch-title">Оформление заявки</h1>
                    
                    <div class="type-switcher">
                        <button type="button" class="type-btn active" onclick="setType('individual')" id="btn-ind">Физическое лицо</button>
                        <button type="button" class="type-btn" onclick="setType('legal')" id="btn-leg">Юридическое лицо</button>
                    </div>

                    <form id="orderForm" onsubmit="submitOrder(event)" novalidate>
                        <input type="hidden" id="clientType" value="individual">

                        <div class="form-group" id="group-phone">
                            <input type="tel" id="phone" class="form-input" placeholder="Ваш телефон *" data-validate="phone">
                            <span class="error-message">Введите номер полностью</span>
                        </div>
                        <div class="form-group" id="group-email">
                            <input type="email" id="email" class="form-input" placeholder="Email (для счета)" data-validate="email">
                            <span class="error-message">Некорректный Email</span>
                        </div>

                        <div id="fields-individual">
                            <div class="form-group" id="group-name">
                                <input type="text" id="name" class="form-input" placeholder="Ваше Имя *" data-validate="text">
                                <span class="error-message">Введите имя</span>
                            </div>
                        </div>

                        <div id="fields-legal" class="legal-fields">
                            <div class="form-group" id="group-company">
                                <input type="text" id="company_name" class="form-input" placeholder="Название компании (ООО/ИП) *" data-validate="text">
                                <span class="error-message">Введите название организации</span>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div class="form-group" id="group-inn">
                                    <input type="text" id="inn" class="form-input" placeholder="ИНН *" data-validate="inn">
                                    <span class="error-message">10 или 12 цифр</span>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="kpp" class="form-input" placeholder="КПП">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="contact_person" class="form-input" placeholder="Контактное лицо *" data-validate="text">
                                <span class="error-message">Введите имя контактного лица</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" id="comment" class="form-input" placeholder="Комментарий к заказу">
                        </div>

                        <button type="submit" class="btn-cart-order btn-submit-order">
                            Отправить заявку
                        </button>
                        <p class="footer-disclaimer" style="margin-top: 15px; text-align: center;">
                            Нажимая кнопку, вы соглашаетесь с политикой обработки персональных данных.
                        </p>
                    </form>
                </div>

                <div class="order-summary-card">
                    <h3 class="os-title">Ваш заказ</h3>
                    <ul class="os-list" id="checkout-list"></ul>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            initValidation();
        });

        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const list = document.getElementById('checkout-list');
            if (cart.length === 0) {
                list.innerHTML = '<li class="os-item" style="justify-content:center; color:#666;">Корзина пуста</li>';
                const btn = document.querySelector('.btn-submit-order');
                btn.disabled = true;
                btn.style.opacity = '0.5';
                btn.innerText = 'Корзина пуста';
                return;
            }
            cart.forEach(item => {
                list.innerHTML += `
                    <li class="os-item">
                        <div class="os-info">
                            <span class="os-name">${item.name}</span>
                            <span class="os-art">${item.number}</span>
                        </div>
                        <span class="os-qty">${item.qty} шт.</span>
                    </li>`;
            });
        }

        function initValidation() {
            const phoneEl = document.getElementById('phone');
            const phoneMask = IMask(phoneEl, { mask: '+{7} (000) 000-00-00' });
            window.phoneMaskGlobal = phoneMask;

            // ВАЖНО: Выбираем только поля с атрибутом data-validate
            document.querySelectorAll('.form-input[data-validate]').forEach(input => {
                input.addEventListener('input', () => {
                    input.closest('.form-group').classList.remove('invalid');
                    if (checkValidity(input)) input.closest('.form-group').classList.add('valid');
                    else input.closest('.form-group').classList.remove('valid');
                });
                
                input.addEventListener('blur', () => {
                    const group = input.closest('.form-group');
                    if (checkValidity(input)) {
                        group.classList.remove('invalid');
                        group.classList.add('valid');
                    } else {
                        if (input.offsetWidth > 0) { 
                            group.classList.remove('valid');
                            group.classList.add('invalid');
                        }
                    }
                });
            });

            // Для поля Комментарий - принудительная очистка стилей
            const comm = document.getElementById('comment');
            if(comm) {
                comm.addEventListener('input', () => comm.closest('.form-group').classList.remove('valid', 'invalid'));
                comm.addEventListener('blur', () => comm.closest('.form-group').classList.remove('valid', 'invalid'));
            }
        }

        function checkValidity(input) {
            const type = input.getAttribute('data-validate');
            const val = input.value.trim();
            if (input.offsetWidth === 0 && input.offsetHeight === 0) return true;

            switch (type) {
                case 'text': return val.length >= 2;
                case 'phone': return window.phoneMaskGlobal && window.phoneMaskGlobal.masked.isComplete;
                case 'email': 
                    if (val.length === 0) return true; 
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
                case 'inn': return /^(\d{10}|\d{12})$/.test(val);
                default: return true;
            }
        }

        function validateAll() {
            let isAllValid = true;
            document.querySelectorAll('.form-input[data-validate]').forEach(input => {
                if (input.offsetWidth > 0) {
                    if (!checkValidity(input)) {
                        isAllValid = false;
                        input.closest('.form-group').classList.add('invalid');
                    }
                }
            });
            return isAllValid;
        }

        function setType(type) {
            document.getElementById('clientType').value = type;
            document.getElementById('btn-ind').classList.toggle('active', type === 'individual');
            document.getElementById('btn-leg').classList.toggle('active', type === 'legal');
            const legFields = document.getElementById('fields-legal');
            const indFields = document.getElementById('fields-individual');
            if (type === 'legal') {
                legFields.classList.add('active');
                indFields.style.display = 'none';
            } else {
                legFields.classList.remove('active');
                indFields.style.display = 'block';
            }
            document.querySelectorAll('.form-group').forEach(g => g.classList.remove('valid', 'invalid'));
        }

        function submitOrder(e) {
            e.preventDefault();
            if (!validateAll()) {
                const firstInvalid = document.querySelector('.form-group.invalid');
                if(firstInvalid) firstInvalid.scrollIntoView({behavior: "smooth", block: "center"});
                if(typeof showToast === 'function') showToast('Проверьте выделенные поля', 'error');
                return;
            }

            const btn = document.querySelector('.btn-submit-order');
            const originalText = btn.innerText;
            btn.innerText = 'Отправка...';
            btn.disabled = true;

            const type = document.getElementById('clientType').value;
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            let formData = {
                type: type,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                comment: document.getElementById('comment').value,
                cart: cart
            };

            if (type === 'individual') {
                formData.name = document.getElementById('name').value;
            } else {
                formData.company_name = document.getElementById('company_name').value;
                formData.inn = document.getElementById('inn').value;
                formData.kpp = document.getElementById('kpp').value;
                formData.contact_person = document.getElementById('contact_person').value;
            }

            fetch('send.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            })
            .then(r => r.json())
            .then(data => {
                if (data.status === 'success') {
                    localStorage.removeItem('cart');
                    if(typeof showToast === 'function') showToast('Заявка успешно отправлена!', 'success');
                    else alert('Заявка отправлена!');
                    setTimeout(() => { window.location.href = 'index.php'; }, 2000);
                } else {
                    if(typeof showToast === 'function') showToast('Ошибка: ' + data.message, 'error');
                    else alert('Ошибка: ' + data.message);
                    btn.innerText = originalText;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                if(typeof showToast === 'function') showToast('Ошибка соединения', 'error');
                btn.innerText = originalText;
                btn.disabled = false;
            });
        }
    </script>
</body>
</html>