const loginlink = document.getElementById('login-link');
const registerlink = document.getElementById('register-link');

if (loginlink != null) {
    loginlink.addEventListener('click', () => {
        login.style.display = 'flex';
        register.style.display = 'none';
    });
}

if (registerlink != null) {
    registerlink.addEventListener('click', () => {
        login.style.display = 'none';
        register.style.display = 'flex';
    });
}