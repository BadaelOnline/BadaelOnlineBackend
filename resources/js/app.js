require('./bootstrap');

// language
const lang = localStorage.getItem('lang') || 'en';
document.documentElement.lang = lang;
