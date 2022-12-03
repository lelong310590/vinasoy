<?php
/**
 * web.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Models\Video;

Route::group(['namespace' => 'Botble\VideoVoting\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix() . '/video-voting', 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'categories', 'as' => 'video-categories.'], function () {
            Route::resource('', 'VideoCategoryController')
                ->parameters(['' => 'video-categories']);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'VideoCategoryController@deletes',
                'permission' => 'video-categories.destroy',
            ]);
        });

        Route::group(['prefix' => 'video', 'as' => 'video.'], function () {
            Route::resource('', 'VideoController')
                ->parameters(['' => 'video']);

            Route::get('view-vote/{id}', [
                'as'         => 'view-vote',
                'uses'       => 'VideoController@viewVote',
                'permission' => 'video.edit',
            ]);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'VideoController@deletes',
                'permission' => 'video.destroy',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
            Route::get('search', [
                'as'   => 'public.search',
                'uses' => 'PublicController@getSearch',
            ]);

            if (SlugHelper::getPrefix(Video::class)) {
                Route::get(SlugHelper::getPrefix(Video::class) . '/{slug}', [
                    'uses' => 'PublicController@getPost',
                ]);
            }

            if (SlugHelper::getPrefix(VideoCategory::class)) {
                Route::get(SlugHelper::getPrefix(VideoCategory::class) . '/{slug}', [
                    'uses' => 'PublicController@getCategory',
                ]);
            }
        });
    }
});
