const loginButton = document.getElementById('login-button');
const login = document.getElementById('login');
const register = document.getElementById('register');
const message = document.getElementById('message-container');
const login_text = document.getElementById('login_text');
const register_text = document.getElementById('register_text');
const cross_login = document.getElementById('cross-login');
const cross_register = document.getElementById('cross-register');
const cross_message = document.getElementById('cross-message');

if (loginButton != null) {
    loginButton.addEventListener('click', () => {
        login.style.display = 'flex';
    });
}

cross_login.addEventListener('click', () => {
    login.style.display = 'none';
});

cross_register.addEventListener('click', () => {
    register.style.display = 'none';
});

login_text.addEventListener('click', () => {
    login.style.display = 'flex';
    register.style.display = 'none';
});

register_text.addEventListener('click', () => {
    login.style.display = 'none';
    register.style.display = 'flex';
});

if (cross_message != null) {
    cross_message.addEventListener('click', () => {
        message.style.display = 'none';
    });
}