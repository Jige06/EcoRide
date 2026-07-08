document.querySelectorAll('.toggle-password').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        const champ = document.querySelector(bouton.dataset.target);
        const icone = bouton.querySelector('i');

        if (champ.type === 'password') {
            champ.type = 'text';
            icone.classList.remove('bi-eye');
            icone.classList.add('bi-eye-slash');
        } else {
            champ.type = 'password';
            icone.classList.remove('bi-eye-slash');
            icone.classList.add('bi-eye');
        }
    });
});