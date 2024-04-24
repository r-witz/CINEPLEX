const loginButton = document.getElementById('login-button');
const login = document.getElementById('login');
const register = document.getElementById('register');
const login_text = document.getElementById('login_text');
const register_text = document.getElementById('register_text');
const cross = document.querySelector('.cross');

loginButton.addEventListener('click', () => {
    login.style.display = 'flex';
});

cross.addEventListener('click', () => {
    login.style.display = 'none';
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