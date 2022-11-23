<?php
/**
 * VideoService.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\Helper;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;
use SeoHelper;
use Theme;
use Eloquent;

class VideoService
{
    /**
     * @param Eloquent $slug
     * @return array|Eloquent
     */
    public function handleFrontRoutes($slug)
    {
        if (!$slug instanceof Eloquent) {
            return $slug;
        }

        $condition = [
            'id'     => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        if (Auth::check() && request()->input('preview')) {
            Arr::forget($condition, 'status');
        }

        switch ($slug->reference_type) {
            case Video::class:
                $post = app(VideoInterface::class)
                    ->getFirstBy($condition, ['*'],
                        ['categories', 'slugable', 'categories.slugable']);

                if (empty($post)) {
                    abort(404);
                }

                Helper::handleViewCount($post, 'viewed_post');

                SeoHelper::setTitle($post->name)
                    ->setDescription($post->description);

                $meta = new SeoOpenGraph;
                if ($post->image) {
                    $meta->setImage(RvMedia::getImageUrl($post->image));
                }
                $meta->setDescription($post->description);
                $meta->setUrl($post->url);
                $meta->setTitle($post->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('posts.edit')) {
                    admin_bar()->registerLink(trans('plugins/vote-video::video.edit_this_post'),
                        route('video.edit', $post->id));
                }

                Theme::breadcrumb()->add(__('Home'), route('public.index'));

                $category = $post->categories->first();
                if ($category) {
                    Theme::breadcrumb()->add($category->name, $category->url);
                }

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, POST_MODULE_SCREEN_NAME, $post);

                Theme::breadcrumb()->add(SeoHelper::getTitle(), $post->url);

                return [
                    'view'         => 'video',
                    'default_view' => 'plugins/vote-video::themes.post',
                    'data'         => compact('post'),
                    'slug'         => $post->slug,
                ];
            case VideoCategory::class:
                $category = app(VideoCategoryInterface::class)
                    ->getFirstBy($condition, ['*'], ['slugable']);

                if (empty($category)) {
                    abort(404);
                }

                SeoHelper::setTitle($category->name)
                    ->setDescription($category->description);

                $meta = new SeoOpenGraph;
                if ($category->image) {
                    $meta->setImage(RvMedia::getImageUrl($category->image));
                }
                $meta->setDescription($category->description);
                $meta->setUrl($category->url);
                $meta->setTitle($category->name);
                $meta->setType('article');

                SeoHelper::setSeoOpenGraph($meta);

                if (function_exists('admin_bar') && Auth::check() && Auth::user()->hasPermission('categories.edit')) {
                    admin_bar()->registerLink(trans('plugins/vote-video::video-category.edit_this_category'),
                        route('video-categories.edit', $category->id));
                }

                $allRelatedCategoryIds = array_unique(array_merge(
                    app(CategoryInterface::class)->getAllRelatedChildrenIds($category),
                    [$category->id]
                ));

                $posts = app(PostInterface::class)
                    ->getByCategory($allRelatedCategoryIds, theme_option('number_of_posts_in_a_category', 12));

                do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CATEGORY_MODULE_SCREEN_NAME, $category);

                Theme::breadcrumb()
                    ->add(__('Home'), route('public.index'))
                    ->add(SeoHelper::getTitle(), $category->url);

                return [
                    'view'         => 'video-category',
                    'default_view' => 'plugins/blog::themes.category',
                    'data'         => compact('category', 'posts'),
                    'slug'         => $category->slug,
                ];
        }

        return $slug;
    }
}
