<?php

namespace Botble\Member\Tables;

use BaseHelper;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MemberTable extends TableAbstract
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
     * MemberTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param MemberInterface $memberRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, MemberInterface $memberRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $memberRepository;

        if (!Auth::user()->hasAnyPermission(['member.edit', 'member.destroy'])) {
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
            ->editColumn('first_name', function ($item) {
                if (!Auth::user()->hasPermission('member.edit')) {
                    return $item->name;
                }

                return Html::link(route('member.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('hrm', function ($item) {
                return $item->hrm;
            })
            ->editColumn('dob', function ($item) {
                return $item->dob;
            })
            ->editColumn('area', function ($item) {
                return $item->area;
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('member.edit', 'member.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'created_at',
            'hrm',
            'dob',
            'area'
        ]);

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
            'first_name' => [
                'title' => trans('core/base::tables.name'),
                'class' => 'text-left',
            ],
            'hrm'      => [
                'title' => 'M?? HRM',
                'class' => 'text-left',
            ],
            'dob'      => [
                'title' => 'Ng??y sinh',
                'class' => 'text-left',
            ],
            'area'      => [
                'title' => 'N??i l??m vi???c',
                'class' => 'text-left',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        return $this->addCreateButton(route('member.create'), 'member.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('member.deletes'), 'member.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'first_name' => [
                'title'    => trans('plugins/member::member.first_name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'last_name'  => [
                'title'    => trans('plugins/member::member.last_name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'hrm'      => [
                'title'    => 'M?? HRM',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
