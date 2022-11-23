<?php

use Botble\Theme\Supports\ThemeSupport;
use Botble\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Botble\Base\Enums\BaseStatusEnum;

app()->booted(function () {

    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('faq')) {
        add_shortcode('faq', __('FAQs'), __('FAQs'), function ($shortCode) {
            $categories = app(FaqCategoryInterface::class)
                ->advancedGet([
                    'condition' => [
                        'status' => BaseStatusEnum::PUBLISHED,
                    ],
                    'with'      => ['faqs'],
                    'order_by'  => [
                        'faq_categories.order'      => 'ASC',
                        'faq_categories.created_at' => 'DESC',
                    ],
                ]);

            return Theme::partial('short-codes.faq', [
                'title'      => $shortCode->title,
                'categories' => $categories,
            ]);
        });

        shortcode()->setAdminConfig('faq', Theme::partial('short-codes.faq-admin-config'));
    }
});
