document.addEventListener("DOMContentLoaded", function (event) {
    window.addEventListener('scroll', function () {
        if (window.scrollY > 90) {
            document.querySelector('body').classList.add('__fixed');
        } else {
            document.querySelector('body').classList.remove('__fixed');
        }
    });
});