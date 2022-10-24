(function ($) {

    'use strict';

    $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/templines-moto-slider.default', function ($scope) {
                if (!$('.slick-initialized', $scope).hasClass('templines-moto-slider')) {
                    fl_theme.initMotoSlider();
                }
            });
    });

})(jQuery);


/*
(function ($) {
    "use strict";

    $(function () {
        if (window.elementorFrontend) {
            console.log(window.elementorFrontend.hooks);
            $('body').on('elementor/frontend/init', function () {
                window.elementorFrontend.hooks.addAction('frontend/element_ready/templines-moto-slider.default', function ($scope) {
                    //fl_theme.initMotoSlider();
                    console.log('222');
                });
            });

        }
    });

})(jQuery);*/