/**
 * Show/hide password + confirm password check (login & register)
 */
document.querySelectorAll('.toggle-password').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var input = document.getElementById(this.dataset.target);
        if (!input) return;

        var icon = this.querySelector('i');
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !show);
        icon.classList.toggle('bi-eye-slash', show);
    });
});

var registerForm = document.getElementById('registerForm');
if (registerForm) {
    var passwordInput = document.getElementById('registerPassword');
    var confirmInput = document.getElementById('confirmPassword');
    var mismatchAlert = document.getElementById('passwordMismatch');

    registerForm.addEventListener('submit', function (e) {
        if (!passwordInput || !confirmInput) return;

        if (passwordInput.value !== confirmInput.value) {
            e.preventDefault();
            if (mismatchAlert) mismatchAlert.classList.remove('d-none');
            confirmInput.focus();
        }
    });

    if (confirmInput) {
        confirmInput.addEventListener('input', function () {
            if (mismatchAlert) mismatchAlert.classList.add('d-none');
        });
    }
}
