document.addEventListener("DOMContentLoaded", function (event) {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            let anchorName = (this.getAttribute('href')).replace('#', '');
            const offset = 170;
            let findTag = document.querySelector('a[name=' + anchorName + ']');
            if (findTag == null) {
                findTag = document.getElementById(anchorName);
            }
            let scrollOfset = findTag.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({
                top: scrollOfset,
                behavior: 'smooth'
            });
        });
    });
});