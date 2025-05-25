head.ready(document, function () {
    head.load('/local/templates/pansion/fonts/styles.css');
});


window.onload = function () {

    setTimeout(function () {
        head.load('/local/templates/pansion/vendor/jquery-3.2.1.min.js', function () {
            head.load('/local/templates/pansion/vendor/jquery.inputmask.bundle.min.js');
            head.load('/local/templates/pansion/vendor/jquery.cookie.js');

            head.load('/local/templates/pansion/vendor/tooltipster/css/tooltipster.bundle.min.css');
            head.load('/local/templates/pansion/vendor/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css');
            head.load('/local/templates/pansion/vendor/fancybox/jquery.fancybox.min.js');
            head.load('/local/templates/pansion/vendor/fancybox/jquery.fancybox.min.css');
            head.load('/local/templates/pansion/js/main.js?ts=' + window.cache_ts, function () {
                var event = new Event('Add2Viewed');
                document.dispatchEvent(event);
            });
            head.load('/local/templates/pansion/js/forms.js?ts=' + window.cache_ts);
            head.load('/local/templates/pansion/js/calc.js?ts=' + window.cache_ts);
        });
    },1000);

};
