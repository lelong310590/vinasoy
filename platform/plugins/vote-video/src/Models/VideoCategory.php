<?php
/**
 * VideoCategory.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Base\Traits\EnumCastable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Html;

class VideoCategory extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vv_video_categories';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'icon',
        'is_featured',
        'order',
        'is_default',
        'status',
        'author_id',
        'author_type',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Video::class, 'vv_video_category_relation', 'category_id', 'video_id')->with('slugable');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class, 'parent_id')->withDefault();
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(VideoCategory::class, 'parent_id');
    }

    /**
     * @return string
     */
    public function getBadgeWithCountAttribute()
    {
        switch ($this->status->getValue()) {
            case BaseStatusEnum::DRAFT:
                $badge = 'bg-secondary';
                break;
            case BaseStatusEnum::PENDING:
                $badge = 'bg-warning';
                break;
            default:
                $badge = 'bg-success';
                break;
        }
        return Html::tag('span', (string)$this->posts_count, [
            'class'               => 'badge font-weight-bold ' . $badge,
            'data-toggle'         => 'tooltip',
            'data-original-title' => trans('plugins/blog::categories.total_posts', ['total' => $this->posts_count])
        ]);
    }

    protected static function boot()
    {
        parent::boot();

        self::deleting(function (VideoCategory $category) {
            VideoCategory::where('parent_id', $category->id)->delete();

            $category->posts()->detach();
        });
    }
}
