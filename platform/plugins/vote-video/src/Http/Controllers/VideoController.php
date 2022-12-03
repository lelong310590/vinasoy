<?php
/**
 * VideoController.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Traits\HasDeleteManyItemsTrait;
use Botble\Blog\Forms\PostForm;
use Botble\Blog\Http\Requests\PostRequest;
use Botble\Blog\Services\StoreCategoryService;
use Botble\Blog\Services\StoreTagService;
use Botble\VideoVoting\Forms\VideoForm;
use Botble\VideoVoting\Http\Requests\VideoRequest;
use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Botble\VideoVoting\Services\StoreVideoCategoryService;
use Botble\VideoVoting\Tables\VideoTable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;
use Illuminate\Contracts\View\Factory;
use Auth;
use Exception;

class VideoController extends BaseController
{
    use HasDeleteManyItemsTrait;

    /**
     * @var VideoInterface
     */
    protected $videoRepository;

    /**
     * @var VideoCategoryInterface
     */
    protected $videoCategoryRepository;

    /**
     * VideoController constructor.
     * @param VideoInterface $videoRepository
     * @param VideoCategoryInterface $videoCategoryRepository
     */
    public function __construct(
        VideoInterface $videoRepository,
        VideoCategoryInterface $videoCategoryRepository
    )
    {
        $this->videoRepository = $videoRepository;
        $this->videoCategoryRepository = $videoCategoryRepository;
    }

    /**
     * @param VideoTable $dataTable
     * @return Factory|View
     * @throws Throwable
     */
    public function index(VideoTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/vote-video::video.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/vote-video::video.create'));

        return $formBuilder->create(VideoForm::class)->renderForm();
    }

    /**
     * @param VideoRequest $request
     * @param StoreVideoCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(
        VideoRequest $request,
        StoreVideoCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        /**
         * @var Video $post
         */
        $post = $this->videoRepository->createOrUpdate(array_merge($request->input(), [
            'author_id'   => Auth::id(),
            'author_type' => User::class,
        ]));

        event(new CreatedContentEvent(VIDEO_MODULE_SCREEN_NAME, $request, $post));

        $categoryService->execute($request, $post);

        return $response
            ->setPreviousUrl(route('video.index'))
            ->setNextUrl(route('video.edit', $post->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $post = $this->videoRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $post));

        page_title()->setTitle(trans('plugins/vote-video::video.edit') . ' "' . $post->name . '"');

        return $formBuilder->create(VideoForm::class, ['model' => $post])->renderForm();
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @param StoreVideoCategoryService $categoryService
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update(
        $id,
        PostRequest $request,
        StoreVideoCategoryService $categoryService,
        BaseHttpResponse $response
    ) {
        $post = $this->videoRepository->findOrFail($id);

        $post->fill($request->input());

        $this->videoRepository->createOrUpdate($post);

        event(new UpdatedContentEvent(VIDEO_MODULE_SCREEN_NAME, $request, $post));

        $categoryService->execute($request, $post);

        return $response
            ->setPreviousUrl(route('video.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy($id, Request $request, BaseHttpResponse $response)
    {
        try {
            $video = $this->videoRepository->findOrFail($id);
            $this->videoRepository->delete($video);

            event(new DeletedContentEvent(VIDEO_MODULE_SCREEN_NAME, $request, $video));

            return $response
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->videoRepository, VIDEO_MODULE_SCREEN_NAME);
    }

    /**
     * @param $id
     * @param VideoTable $dataTable
     * @return \Illuminate\Http\JsonResponse|View
     * @throws Throwable
     */
    public function viewVote($id, VideoTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/vote-video::video.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Throwable
     */
    public function getWidgetRecentPosts(Request $request, BaseHttpResponse $response)
    {
        $limit = (int)$request->input('paginate', 10);
        $limit = $limit > 0 ? $limit : 10;

        $posts = $this->videoRepository->advancedGet([
            'with'     => ['slugable'],
            'order_by' => ['created_at' => 'desc'],
            'paginate' => [
                'per_page'      => $limit,
                'current_paged' => (int)$request->input('page', 1),
            ],
        ]);

        return $response
            ->setData(view('plugins/blog::posts.widgets.posts', compact('posts', 'limit'))->render());
    }
}
