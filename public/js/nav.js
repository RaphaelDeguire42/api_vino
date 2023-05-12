const primaryNav = document.querySelector('[data-js-primary-navigation]');
const navToggle = document.querySelector('[data-js-burger]');


navToggle.addEventListener('click', () => {
    const visibility = primaryNav.dataset.jsPrimaryNavigation;
    
    if (visibility == "false") {
        primaryNav.dataset.jsPrimaryNavigation = "true";
        navToggle.setAttribute('aria-expanded', true);
    }else if(visibility == "true") {
        primaryNav.dataset.jsPrimaryNavigation = "false";
        navToggle.setAttribute('aria-expanded', false);
    }
})