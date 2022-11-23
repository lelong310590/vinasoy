<?php

use Botble\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
     */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
     */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before'             => function (Theme $theme) {

        },
        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme'  => function (Theme $theme) {
            // You may use this event to set up your assets.

            $version = '1.0.0';

            $theme->asset()->container('footer')->usePath()->add('jquery', 'plugins/jquery/jquery.min.js');
            $theme->asset()->container('footer')->usePath()
                ->add('bootstrap-js', 'plugins/bootstrap/js/bootstrap.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('waterwheel-js', 'plugins/waterwheel/js/jquery.waterwheelCarousel.js', ['jquery']);
            $theme->asset()->container('footer')->add('fancy-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()->add('owl-js', 'plugins/owlcarousel/dist/owl.carousel.min.js', ['jquery']);
            $theme->asset()->container('footer')->add('sa2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', ['jquery']);
            $theme->asset()->container('footer')->add('dropzone', 'https://unpkg.com/dropzone@5/dist/min/dropzone.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()->add('parsley', 'plugins/parsley/parsley.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()->add('tavoting-js', 'js/tavoting.js', ['jquery']);

            $theme->asset()->usePath()->add('bootstrap-css', 'plugins/bootstrap/css/bootstrap.min.css');
            $theme->asset()->usePath()->add('owl-css', 'plugins/owlcarousel/dist/assets/owl.carousel.min.css');
            $theme->asset()->usePath()->add('owl-theme-css', 'plugins/owlcarousel/dist/assets/owl.theme.default.min.css');
            $theme->asset()->add('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css');
            $theme->asset()->add('fancy', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
            $theme->asset()->add('dropzone', 'https://unpkg.com/dropzone@5/dist/min/dropzone.min.css');
            $theme->asset()->add('sa2', 'https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css');
            $theme->asset()->usePath()->add('style', 'css/style.css', [], [], $version);

            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post'], function (\Botble\Shortcode\View\View $view) {
                    $view->withShortcodes();
                });
            }
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [
            'default' => function (Theme $theme) {},
        ],
    ],
];
