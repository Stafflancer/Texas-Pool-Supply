(function ($) {
    $(document).on('ready', function () {
        let heroBannerHomeSlider = $('section.hero-banner-home .bg-images');
        if (heroBannerHomeSlider.length) {
            heroBannerHomeSlider.each(function () {
                $(this).slick({
                    dots: false,
                    arrows: false,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 4000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                });
            });
        }
    });
})(jQuery);