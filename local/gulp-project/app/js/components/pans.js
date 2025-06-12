
// Function that actually builds the swiper
const buildSwiperSlider = sliderElm => {
    const sliderIdentifier = sliderElm.dataset.id;
    // console.log(sliderIdentifier)
    // console.log(`.swiper-button-next-${sliderIdentifier}`);

    return new Swiper('.' + sliderIdentifier, {
        navigation: {
            nextEl: `.next-${sliderIdentifier}`,
            prevEl: `.prev-${sliderIdentifier}`
        },
        lazy: true,
        on: {
            slideChange: function () {
                let status = $('.' + sliderIdentifier).parent().find('.js-text');
                status.text((this.activeIndex + 1) + ' из ' + this.slides.length);

                let cur = this.slides[this.activeIndex];
                if (cur.hasAttribute('data-background')) {
                    let attr = $(cur).attr('data-background');
                    cur.style.backgroundImage = 'url(' + attr + ')';
                    cur.removeAttribute('data-background');
                }
            }
        },

    });
}
// Get all of the swipers on the page
const allSliders = document.querySelectorAll('.js_sectionSlider');
// Loop over all of the fetched sliders and apply Swiper on each one.
allSliders.forEach(slider => buildSwiperSlider(slider));


$('.detail__bages-close').click(function (e) {
    $('.detail__bages').fadeOut();
})