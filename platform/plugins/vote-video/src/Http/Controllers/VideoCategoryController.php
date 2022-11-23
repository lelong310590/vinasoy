<?php
/**
 * VideoCategoryController.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

namespace Botble\VideoVoting\Http\Controllers;

use Botble\ACL\Models\User;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\VideoVoting\Forms\VideoCategoryForm;
use Botble\VideoVoting\Http\Requests\VideoCategoryRequest;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Assets;
use Exception;
use Illuminate\Http\Request;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Auth;

class VideoCategoryController extends BaseController
{
    /**
     * @var VideoCategoryInterface
     */
    protected $videoCategoryRepository;

    /**
     * VideoCategoryController constructor.
     * @param VideoCategoryInterface $videoCategoryRepository
     */
    public function __construct(VideoCategoryInterface $videoCategoryRepository)
    {
        $this->videoCategoryRepository = $videoCategoryRepository;
    }

    /**
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|string
     */
    public function index(FormBuilder $formBuilder, Request $request, BaseHttpResponse $response)
    {
        page_title()->setTitle(trans('plugins/blog::categories.menu'));

        $categories = $this->videoCategoryRepository->getCategories(['*'], [
            'created_at' => 'DESC',
            'is_default' => 'DESC',
            'order'      => 'ASC',
        ]);

        $categories->load('slugable')->loadCount('posts');

        if ($request->ajax()) {
            $data = view('core/base::forms.partials.tree-categories', $this->getOptions(compact('categories')))->render();

            return $response->setData($data);
        }

        Assets::addStylesDirectly(['vendor/core/core/base/css/tree-category.css'])
            ->addScriptsDirectly(['vendor/core/core/base/js/tree-category.js']);

        $form = $formBuilder->create(VideoCategoryForm::class, ['template' => 'core/base::forms.form-tree-category']);
        $form = $this->setFormOptions($form, null, compact('categories'));

        return $form->renderForm();
    }

    /**
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|string
     */
    public function create(FormBuilder $formBuilder, Request $request, BaseHttpResponse $response)
    {
        page_title()->setTitle(trans('plugins/blog::categories.create'));

        if ($request->ajax()) {
            return $response->setData($this->getForm());
        }

        return $formBuilder->create(VideoCategoryForm::class)->renderForm();
    }

    /**
     * @param VideoCategoryRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(VideoCategoryRequest $request, BaseHttpResponse $response)
    {
        if ($request->input('is_default')) {
            $this->videoCategoryRepository->getModel()->where('id', '>', 0)->update(['is_default' => 0]);
        }

        $category = $this->videoCategoryRepository->createOrUpdate(array_merge($request->input(), [
            'author_id'   => Auth::id(),
            'author_type' => User::class,
        ]));

        event(new CreatedContentEvent(CATEGORY_MODULE_SCREEN_NAME, $request, $category));

        if ($request->ajax()) {
            $category = $this->videoCategoryRepository->findOrFail($category->id);

            if ($request->input('submit') == 'save') {
                $form = $this->getForm();
            } else {
                $form = $this->getForm($category);
            }

            $response->setData([
                'model' => $category,
                'form'  => $form
            ]);
        }

        return $response
            ->setPreviousUrl(route('video-categories.index'))
            ->setNextUrl(route('video-categories.edit', $category->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request, BaseHttpResponse $response)
    {
        $category = $this->videoCategoryRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $category));

        if ($request->ajax()) {
            return $response->setData($this->getForm($category));
        }

        page_title()->setTitle(trans('plugins/blog::categories.edit') . ' "' . $category->name . '"');

        return $formBuilder->create(VideoCategoryForm::class, ['model' => $category])->renderForm();
    }

    /**
     * @param $id
     * @param VideoCategoryRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, VideoCategoryRequest $request, BaseHttpResponse $response)
    {
        $category = $this->videoCategoryRepository->findOrFail($id);

        if ($request->input('is_default')) {
            $this->videoCategoryRepository->getModel()->where('id', '!=', $id)->update(['is_default' => 0]);
        }

        $category->fill($request->input());

        $this->videoCategoryRepository->createOrUpdate($category);

        event(new UpdatedContentEvent(CATEGORY_MODULE_SCREEN_NAME, $request, $category));

        if ($request->ajax()) {
            $category = $this->videoCategoryRepository->findOrFail($id);

            if ($request->input('submit') == 'save') {
                $form = $this->getForm();
            } else {
                $form = $this->getForm($category);
            }
            $response->setData([
                'model' => $category,
                'form'  => $form
            ]);
        }

        return $response
            ->setPreviousUrl(route('video-categories.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $category = $this->videoCategoryRepository->findOrFail($id);

            if (!$category->is_default) {
                $this->videoCategoryRepository->delete($category);
                event(new DeletedContentEvent(CATEGORY_MODULE_SCREEN_NAME, $request, $category));
            }

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
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
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $category = $this->videoCategoryRepository->findOrFail($id);
            if (!$category->is_default) {
                $this->videoCategoryRepository->delete($category);

                event(new DeletedContentEvent(CATEGORY_MODULE_SCREEN_NAME, $request, $category));
            }
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    /**
     * @param VideoCategoryForm|null $model
     * @return string
     */
    protected function getForm($model = null)
    {
        $options = ['template' => 'core/base::forms.form-no-wrap'];

        if ($model) {
            $options['model'] = $model;
        }

        $form = app(FormBuilder::class)->create(VideoCategoryForm::class, $options);

        $form = $this->setFormOptions($form, $model);

        return $form->renderForm();
    }

    /**
     * @param FormAbstract $form
     * @param array $options
     * @return FormAbstract
     */
    protected function setFormOptions($form, $model = null, $options = [])
    {
        if (!$model) {
            $form->setUrl(route('video-categories.create'));
        }

        if (!Auth::user()->hasPermission('video_categories.create') && !$model) {
            $class = $form->getFormOption('class');
            $form->setFormOption('class', $class . ' d-none');
        }

        $form->setFormOptions($this->getOptions($options));

        return $form;
    }

    /**
     * @param array $options
     * @return array
     */
    protected function getOptions($options = [])
    {
        return array_merge([
            'canCreate'   => Auth::user()->hasPermission('video_categories.create'),
            'canEdit'     => Auth::user()->hasPermission('video_categories.edit'),
            'canDelete'   => Auth::user()->hasPermission('video_categories.destroy'),
            'createRoute' => 'video-categories.create',
            'editRoute'   => 'video-categories.edit',
            'deleteRoute' => 'video-categories.destroy',
        ], $options);
    }
}
