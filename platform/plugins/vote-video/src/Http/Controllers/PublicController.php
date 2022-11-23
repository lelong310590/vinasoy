<?php
/**
 * PublicController.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Http\Controllers;


use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Blog\Models\Tag;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Services\BlogService;
use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Models\VideoCategory;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Botble\VideoVoting\Services\VideoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Response;
use SeoHelper;
use SlugHelper;
use Theme;

class PublicController extends Controller
{
    /**
     * @param Request $request
     * @param VideoInterface $postRepository
     * @return \Botble\Theme\Facades\Response|Response
     */
    public function getSearch(Request $request, VideoInterface $postRepository)
    {
        $query = $request->input('q');

        $title = __('Search result for: ":query"', compact('query'));
        SeoHelper::setTitle($title)
            ->setDescription($title);

        $posts = $postRepository->getSearch($query, 0, 12);

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add($title, route('public.search'));

        return Theme::scope('search', compact('posts'))
            ->render();
    }


    /**
     * @param string $slug
     * @param BlogService $blogService
     * @return RedirectResponse|Response
     */
    public function getPost($slug, VideoService $blogService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(Video::class));

        if (!$slug) {
            abort(404);
        }

        $data = $blogService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(Video::class) . '/' . $data['slug']));
        }

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }

    /**
     * @param $slug
     * @param VideoService $videoService
     * @return \Botble\Theme\Facades\Response|RedirectResponse|Response
     */
    public function getCategory($slug, VideoService $videoService)
    {
        $slug = SlugHelper::getSlug($slug, SlugHelper::getPrefix(VideoCategory::class));

        if (!$slug) {
            abort(404);
        }

        $data = $videoService->handleFrontRoutes($slug);

        if (isset($data['slug']) && $data['slug'] !== $slug->key) {
            return redirect()->to(route('public.single', SlugHelper::getPrefix(VideoCategory::class) . '/' . $data['slug']));
        }

        return Theme::scope($data['view'], $data['data'], $data['default_view'])
            ->render();
    }
}
