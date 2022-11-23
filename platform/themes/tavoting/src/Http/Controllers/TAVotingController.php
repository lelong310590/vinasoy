<?php
/**
 * TAVotingController.php
 * Created by: trainheartnet
 * Created at: 20/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

namespace Theme\TAVoting\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Theme\Http\Controllers\PublicController;
use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;
use EmailHandler;
use Exception;
use SlugHelper;
use SeoHelper;
use RvMedia;

class TAVotingController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex()
    {
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function getView($key = null)
    {
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }

    /**
     * Search post
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param PostInterface $postRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws FileNotFoundException
     */
    public function getSearch(Request $request, PostInterface $postRepository, BaseHttpResponse $response)
    {
        $query = $request->input('q');

        if (!empty($query)) {
            $posts = $postRepository->getSearch($query);

            $data = [
                'items' => Theme::partial('search', compact('posts')),
                'query' => $query,
                'count' => $posts->count(),
            ];

            if ($data['count'] > 0) {
                return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data, 10, 1));
            }
        }

        return $response
            ->setError()
            ->setMessage(__('No results found, please try with different keywords.'));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws \Throwable
     */
    public function sendRegister(
        Request $request,
        BaseHttpResponse $response
    )
    {
        if (!$request->ajax()) {
            return $response->setCode(404);
        }

        try {
//            $listMail = ['longlengoc90@gmail.com'];
            $listMail = ['giang.doan@pointavenue.com', 'thuyquynh.nguyen@pointavenue.com', 'phuong.hoang@pointavenue.com', 'speak2inspire@pointavenue.com'];

            $fullname = $request->get('fullname');
            $phone = $request->get('phone');
            $email = $request->get('email');
            $address = $request->get('address');
            $age = $request->get('age');
            $category = $request->get('category');
            $guardian_name = $request->get('guardian_name');
            $guardian_phone = $request->get('guardian_phone');
            $guardian_email = $request->get('guardian_email');
            $video_link = $request->get('video_link');

            $videoCategory = app(VideoCategoryInterface::class)->getModel()->whereIn('id', $category)->get();
            $videoCategoryString = '';
            foreach ($videoCategory as $vc) {
                $videoCategoryString .= $vc->name . ', ';
            }

            $data = [
                'fullname' => $fullname,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'age' => $age,
                'category' => $videoCategoryString,
                'guardian_name' => $guardian_name,
                'guardian_phone' => $guardian_phone,
                'guardian_email' => $guardian_email,
                'video_link' => $video_link,
            ];

            //Store to DB
            $draftVideo = app(VideoInterface::class)->create([
                'name' => $fullname,
                'status' => 'draft',
                'author_id' => 1,
                'age_group' => $age,
                'youtube_link' => $video_link,
                'video_author_name' => $fullname,
                'video_author_email' => $email,
                'video_author_phone' => $phone,
                'video_author_address' => $address,
                'guardian_name' => $guardian_name,
                'guardian_phone' => $guardian_phone,
                'guardian_email' => $guardian_email
            ]);

            $draftVideo->categories()->sync($category);

            foreach ($listMail as $to) {
                EmailHandler::setModule(VIDEO_MODULE_SCREEN_NAME)
                    ->setVariableValues($data)
                    ->sendUsingTemplate('register', $to);
            }

            return $response->setData(trans('core/setting::setting.test_email_send_success'));
        } catch (Exception $exception) {
            return $response->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function vote(
        Request $request,
        BaseHttpResponse $response
    )
    {
        if (!$request->ajax()) {
            return $response->setCode(404);
        }

        if (!auth('member')->check()) {
            return $response->setCode(404);
        }

        //Process vote
        $videoId = $request->get('videoId');
        app(VideoInterface::class)->getModel()->find($videoId)->increment('vote', 1);
        $loggedUser = auth('member')->user();
        $loggedUser->videoVoted()->attach($videoId);

        return $response->setCode(200);
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function devote(
        Request $request,
        BaseHttpResponse $response
    )
    {
        if (!$request->ajax()) {
            return $response->setCode(404);
        }

        if (!auth('member')->check()) {
            return $response->setCode(404);
        }

        //Process vote
        $videoId = $request->get('videoId');
        app(VideoInterface::class)->getModel()->find($videoId)->decrement('vote', 1);
        $loggedUser = auth('member')->user();
        $loggedUser->videoVoted()->detach($videoId);

        return $response->setCode(200);
    }

    /**
     * @param $slug
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return \Botble\Theme\Facades\Response|\Response
     */
    public function getVideoCategory(
        $slug
    )
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(VideoCategory::class));

        if (!$slug) {
            abort(404);
        }

        $condition = [
            'id'     => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

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
            admin_bar()->registerLink(trans('plugins/blog::categories.edit_this_category'),
                route('video-categories.edit', $category->id));
        }

        $videos = app(VideoInterface::class)
            ->getByCategory($category->id, theme_option('number_of_posts_in_a_category', 12));

        $listVoted = [];

        if (auth()->guard('member')->check()) {
            $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
        }

        return Theme::scope('video-category', compact('category', 'videos', 'listVoted'))->render();
    }

    /**
     * @param $slug
     * @return \Botble\Theme\Facades\Response|\Response
     */
    public function getVideo(
        $slug
    )
    {
        Theme::asset()->container('footer')
            ->add('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-559b90a455f99f24', ['jquery']);

        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Video::class));

        if (!$slug) {
            abort(404);
        }

        $condition = [
            'id'     => $slug->reference_id,
            'status' => BaseStatusEnum::PUBLISHED,
        ];

        $video = app(VideoInterface::class)
            ->getFirstBy($condition, ['*'], ['slugable']);

        if (empty($video)) {
            abort(404);
        }

        SeoHelper::setTitle($video->name)
            ->setDescription($video->description);

        $meta = new SeoOpenGraph;
        if ($video->image) {
            $meta->setImage(RvMedia::getImageUrl($video->image));
        }
        $meta->setDescription($video->description);
        $meta->setUrl($video->url);
        $meta->setTitle($video->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        $listVoted = [];

        if (auth()->guard('member')->check()) {
            $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
        }

        if ($video->first_category->id != 1) {
            return Theme::scope('video-proud', compact('video', 'listVoted'))->render();
        } else {
            return Theme::scope('video', compact('video', 'listVoted'))->render();
        }

    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return \Botble\Theme\Facades\Response|\Response
     */
    public function getVideoSearch(
        Request $request,
        BaseHttpResponse $response
    )
    {
        $query = $request->input('keywords');

        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $videos = app(VideoInterface::class)->getSearch($query, 0, 12);

        $listVoted = [];

        if (auth()->guard('member')->check()) {
            $listVoted = auth()->guard('member')->user()->videoVoted()->get()->pluck('id')->toArray();
        }

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.search'));

        return Theme::scope('search', compact('videos', 'title', 'listVoted'))
            ->render();
    }

    public function getVideoThumbnail(
        Request $request,
        BaseHttpResponse $response
    )
    {
        if (!$request->ajax()) {
            return $response->setCode(404);
        }

        $videoLink = $request->get('video_link');
        $image = '';
        try {
            if (str_contains($videoLink, 'youtu')) {
                $imageArray = explode('?v=', $videoLink);
                $image = 'https://img.youtube.com/vi/'.$imageArray[1].'/hqdefault.jpg';
            } elseif (str_contains($videoLink, 'vimeo')) {
                $imageArray = explode('vimeo.com/', $videoLink);
                $image = getVimeoThumb($imageArray[1]);
            }

            return $image;
        } catch (Exception $e) {
            return RvMedia::getDefaultImage();
        }
    }

}
