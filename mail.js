

document.addEventListener('DOMContentLoaded', function () {

    // Script google reCAPTCHA rechargement différé
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
        'sitekey' : '6LdGbTUpAAAAAE4Leefo1Zqo9DikcezmXoJDnVeg'
        });
    };

    const form = document.getElementById('contact-form'); // Sélectionnez votre formulaire en fonction de votre structure HTML
    const resultContainer = document.getElementById('result-container');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('mail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            resultContainer.innerHTML = data.message;

            if (data.status === 'success') {
                form.reset(); // Réinitialise le formulaire en cas de succès
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête AJAX:', error);
        });
    });
});
