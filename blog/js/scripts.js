/*!
* Start Bootstrap - Clean Blog v6.0.9 (https://startbootstrap.com/theme/clean-blog)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-clean-blog/blob/master/LICENSE)
*/
window.addEventListener('DOMContentLoaded', () => {
    let scrollPos = 0;
    const mainNav = document.getElementById('mainNav');
    const headerHeight = mainNav.clientHeight;
    window.addEventListener('scroll', function() {
        const currentTop = document.body.getBoundingClientRect().top * -1;
        if ( currentTop < scrollPos) {
            // Scrolling Up
            if (currentTop > 0 && mainNav.classList.contains('is-fixed')) {
                mainNav.classList.add('is-visible');
            } else {
                console.log(123);
                mainNav.classList.remove('is-visible', 'is-fixed');
            }
        } else {
            // Scrolling Down
            mainNav.classList.remove(['is-visible']);
            if (currentTop > headerHeight && !mainNav.classList.contains('is-fixed')) {
                mainNav.classList.add('is-fixed');
            }
        }
        scrollPos = currentTop;
    });
})

document.getElementById('submitButton').addEventListener('click', function(event) {
    event.preventDefault(); // Formun varsayılan gönderimini engelle

    // Formu seç
    var form = document.getElementById('contactForm');
    
    // Form verilerini topla
    var formData = new FormData(form);

    // Form alanlarını kontrol et
    var name = formData.get('name').trim();
    var email = formData.get('email').trim();
    var phone = formData.get('phone').trim();
    var message = formData.get('message').trim();

    // Hata mesajını sıfırla
    var errorMessage = document.getElementById('submitErrorMessage');
    errorMessage.textContent = '';
    errorMessage.classList.add('d-none');

    // Boş alanları kontrol et
    if (!name || !email || !phone || !message) {
        // Hata mesajını göster
        errorMessage.textContent = 'Lütfen tüm alanları doldurun.';
        errorMessage.classList.remove('d-none');
        setTimeout(() => {
            errorMessage.classList.add('d-none');
        }, 3000);
        return; // Fonksiyonun devamını engelle
    }
    
    // E-posta adresinde @ işareti kontrolü
    if (!email.includes('@')) {
        // E-posta formatı hatalı mesajını göster
        errorMessage.textContent = 'Geçerli bir e-posta adresi girin.';
        errorMessage.classList.remove('d-none');
        return; // Fonksiyonun devamını engelle
    }

    // AJAX isteği gönder
    fetch('compoment/process-contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Başarı mesajını göster
            document.getElementById('submitSuccessMessage').classList.remove('d-none');
            // Formu temizle
            form.reset();
          
            setTimeout(() => {
                document.getElementById('submitSuccessMessage').classList.add('d-none');
            }, 3000);
        } else {
            // Hata mesajını göster
            errorMessage.textContent = data.message || 'Hata oluştu!';
            errorMessage.classList.remove('d-none');
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        // Hata mesajını göster
        errorMessage.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        errorMessage.classList.remove('d-none');
        console.error('Error:', error);
    });
});
