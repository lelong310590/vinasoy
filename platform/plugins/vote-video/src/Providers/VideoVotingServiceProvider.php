<?php
/**
 * VideoVotingServiceProvider.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

namespace Botble\VideoVoting\Providers;

use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Repositories\Caches\VideoCacheDecorator;
use Botble\VideoVoting\Repositories\Caches\VideoCategoryCacheDecorator;
use Botble\VideoVoting\Repositories\Eloquent\VideoCategoryRepository;
use Botble\VideoVoting\Repositories\Eloquent\VideoRepository;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use SlugHelper;
use Botble\Base\Supports\Helper;
use EmailHandler;
use SeoHelper;
use Note;
use Language;
use Gallery;

class VideoVotingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(VideoCategoryInterface::class, function () {
            return new VideoCategoryCacheDecorator(new VideoCategoryRepository(new VideoCategory()));
        });

        $this->app->bind(VideoInterface::class, function () {
            return new VideoCacheDecorator(new VideoRepository(new Video()));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        SlugHelper::registerModule(VideoCategory::class, 'Video Category');
        SlugHelper::registerModule(Video::class, 'Video');

        SlugHelper::setPrefix(VideoCategory::class, 'video-category');
        SlugHelper::setPrefix(Video::class, 'video');

        $this->setNamespace('plugins/vote-video')
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations()
            ->publishAssets();

        $this->app->booted(function () {
            EmailHandler::addTemplateSettings(VIDEO_MODULE_SCREEN_NAME, config('plugins.vote-video.email', []));
        });

        $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'cms-plugins-vote-video',
                    'priority'    => 3,
                    'parent_id'   => null,
                    'name'        => 'plugins/vote-video::base.menu_name',
                    'icon'        => 'fa fa-video',
                    'url'         => route('video.index'),
                    'permissions' => ['video.index'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-video',
                    'priority'    => 1,
                    'parent_id'   => 'cms-plugins-vote-video',
                    'name'        => 'plugins/vote-video::video.menu_name',
                    'icon'        => null,
                    'url'         => route('video.index'),
                    'permissions' => ['video.index'],
                ])
                ->registerItem([
                    'id'          => 'cms-plugins-vote-video-categories',
                    'priority'    => 2,
                    'parent_id'   => 'cms-plugins-vote-video',
                    'name'        => 'plugins/vote-video::video-category.menu_name',
                    'icon'        => null,
                    'url'         => route('video-categories.index'),
                    'permissions' => ['video_categories.index'],
                ]);
        });

        $this->app->booted(function () {
            $models = [Video::class, VideoCategory::class];

//            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
//                Language::registerModule($models);
//            }

            SeoHelper::registerModule($models);

            Gallery::registerModule($models);

            $configKey = 'packages.revision.general.supported';
            config()->set($configKey, array_merge(config($configKey, []), [Video::class]));

            if (defined('NOTE_FILTER_MODEL_USING_NOTE')) {
                Note::registerModule(Video::class);
            }
        });
    }
}
