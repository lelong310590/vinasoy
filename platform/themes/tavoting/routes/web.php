<?php

use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Models\Video;

// Custom routes
Route::group(['namespace' => 'Theme\TAVoting\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        // Add your custom route here
        // Ex: Route::get('hello', 'RippleController@getHello');

        Route::get('ajax/search', 'TAVotingController@getSearch')->name('public.ajax.search');

        Route::post('ajax/send-register', 'TAVotingController@sendRegister')
            ->name('public.ajax.send-register');

        Route::post('ajax/video-vote', 'TAVotingController@vote')
            ->name('public.ajax.vote');

        Route::post('ajax/get-video-thumb', 'TAVotingController@getVideoThumbnail')
            ->name('public.ajax.get-video-thumb');
    });
});

Theme::routes();

Route::group(['namespace' => 'Theme\TAVoting\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'TAVotingController@getIndex')->name('public.index');

        Route::group([
            'middleware' => ['web', 'core'],
            'as'         => 'public.member.',
        ], function () {

            Route::group(['middleware' => ['member.guest']], function () {
                Route::get('login', 'LoginController@showLoginForm')->name('login');
                Route::post('login', 'LoginController@login')->name('login.post');

                Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('register', 'RegisterController@register')->name('register.post');

                Route::get('verify', 'RegisterController@getVerify')->name('verify');

                Route::get('password/request',
                    'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            });

            Route::group([
                'middleware' => [
                    setting('verify_account_email',
                        config('plugins.member.general.verify_email')) ? 'member.guest' : 'member',
                ],
            ], function () {
                Route::get('register/confirm/resend',
                    'RegisterController@resendConfirmation')->name('resend_confirmation');
                Route::get('register/confirm/{user}', 'RegisterController@confirm')->name('confirm');
            });
        });

        Route::get('sitemap.xml', [
            'as'   => 'public.sitemap',
            'uses' => 'TAVotingController@getSiteMap',
        ]);

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), [
            'as'   => 'public.single',
            'uses' => 'TAVotingController@getView',
        ]);

        if (SlugHelper::getPrefix(VideoCategory::class)) {
            Route::get(SlugHelper::getPrefix(VideoCategory::class) . '/{slug}', [
                'as' => 'public.video-category',
                'uses' => 'TAVotingController@getVideoCategory'
            ]);
        }

        if (SlugHelper::getPrefix(Video::class)) {

            Route::get(SlugHelper::getPrefix(Video::class) . '/{slug}/', [
                'as' => 'public.video',
                'uses' => 'TAVotingController@getVideo'
            ]);

            Route::get(SlugHelper::getPrefix(Video::class) . '/search/s', [
                'as' => 'public.video.search',
                'uses' => 'TAVotingController@getVideoSearch'
            ]);
        }
    });
});

