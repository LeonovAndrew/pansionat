window.addEventListener('load', function (e) {
    if (document.querySelector(".js-datepicker") != null) {
        addScript(vendorPath + 'datepicker.js', function () {
            $('.js-datepicker').datepicker({autoClose: true});
        });
    }
});

// if (document.querySelector(".js-datepicker") != null) {
//     $('.js-datepicker').datepicker({autoClose: true});
// }