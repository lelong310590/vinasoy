<?php
/**
 * VideoTable.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Tables;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Repositories\Interfaces\CategoryInterface;
use Botble\Table\Abstracts\TableAbstract;
use Botble\VideoVoting\Exports\VideoExport;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Botble\VideoVoting\Repositories\Interfaces\VideoInterface;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Html;
use BaseHelper;

class VideoTable extends TableAbstract
{
    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var VideoCategoryInterface
     */
    protected $videoCategoryRepository;

    /**
     * @var string
     */
    protected $exportClass = VideoExport::class;

    /**
     * @var int
     */
    protected $defaultSortColumn = 6;

    /**
     * PostTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param VideoInterface $videoRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlGenerator,
        VideoInterface $videoRepository,
        VideoCategoryInterface $videoCategoryRepository
    ) {
        parent::__construct($table, $urlGenerator);

        $this->repository = $videoRepository;
        $this->videoCategoryRepository = $videoCategoryRepository;

        if (!Auth::user()->hasAnyPermission(['video.edit', 'video.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('video.edit')) {
                    return $item->name;
                }

                return Html::link(route('video.edit', $item->id), $item->name);
            })
            ->editColumn('image', function ($item) {
                return $this->displayThumbnail($item->image);
            })
            ->editColumn('vote', function ($item) {
                return $item->vote;
            })
            ->editColumn('youtube_link', function ($item) {
                return $item->youtube_link;
//                if ($item->youtube_link != null && $item->youtube_link != '') {
//                    return '<a class="btn btn-icon btn-sm btn-success" target="_blank" href="'.$item->youtube_link.'"><i class="fa fa-video"></i></a>';
//                } else {
//                    return '<a class="btn btn-icon btn-sm btn-warning" disabled target="_blank"><i class="fa fa-video"></i></a>';
//                }

            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
//            ->editColumn('created_at', function ($item) {
//                return BaseHelper::formatDate($item->created_at);
//            })
            ->editColumn('created_at', function ($item) {
                return $item->url;
            })
            ->editColumn('updated_at', function ($item) {
                $categories = '';
                foreach ($item->categories as $category) {
                    $categories .= Html::link(route('video-categories.edit', $category->id), $category->name) . ', ';
                }

                return rtrim($categories, ', ');
            })
            ->editColumn('status', function ($item) {
                if ($this->request()->input('action') === 'excel') {
                    return $item->status->getValue();
                }

                return $item->status->toHtml();
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('video.edit', 'video.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->with([
                'categories' => function ($query) {
                    $query->select(['vv_video_categories.id', 'vv_video_categories.name']);
                },
                'author'
            ])
            ->select([
                'id',
                'name',
                'image',
                'created_at',
                'status',
                'updated_at',
                'youtube_link',
                'vote'
            ])
            ->orderBy('created_at', 'desc');

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id'         => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'image'      => [
                'title' => trans('core/base::tables.image'),
                'width' => '70px',
            ],
            'name'       => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'youtube_link'       => [
                'title' => 'Link Video',
                'class' => 'text-left',
            ],
            'vote'       => [
                'title' => 'Lượt bình chọn',
                'class' => 'text-left',
            ],
            'updated_at' => [
                'title'     => trans('plugins/vote-video::video.categories'),
                'width'     => '150px',
                'class'     => 'no-sort text-center',
                'orderable' => true,
            ],
            'created_at' => [
                'title' => 'URL',
                'width' => '100px',
                'class' => 'text-center',
            ],
            'status'     => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
                'class' => 'text-center',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        return $this->addCreateButton(route('video.create'), 'video.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('video.deletes'), 'video.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'name'       => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'status'     => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'created_at' => [
                'title'    => trans('core/base::tables.created_at'),
                'type'     => 'date',
                'validate' => 'required',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->videoCategoryRepository->pluck('name', 'id');
    }

    /**
     * {@inheritDoc}
     */
    public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    {
        switch ($key) {
            case 'created_at':
                if (!$value) {
                    break;
                }

                $value = BaseHelper::formatDate($value);

                return $query->whereDate($key, $operator, $value);
            case 'category':
                if (!$value) {
                    break;
                }

                if (!BaseHelper::isJoined($query, 'vv_video_category_relation')) {
                    $query = $query
                        ->join('vv_video_category_relation', 'vv_video_category_relation.video_id', '=', 'vv_videos.id')
                        ->join('vv_video_categories', 'vv_video_category_relation.category_id', '=', 'vv_video_categories.id')
                        ->select($query->getModel()->getTable() . '.*');
                }

                return $query->where('vv_video_category_relation.category_id', $value);
        }

        return parent::applyFilterCondition($query, $key, $operator, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function saveBulkChangeItem($item, string $inputKey, ?string $inputValue)
    {
        if ($inputKey === 'category') {
            $item->categories()->sync([$inputValue]);

            return $item;
        }

        return parent::saveBulkChangeItem($item, $inputKey, $inputValue);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
