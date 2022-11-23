<?php
/**
 * StoreVideoCategoryServiceAbstract.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Services\Abstracts;

use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Repositories\Interfaces\VideoCategoryInterface;
use Illuminate\Http\Request;

abstract class StoreVideoCategoryServiceAbstract
{
    /**
     * @var VideoCategoryInterface
     */
    protected $videoCategoryRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     * @param VideoCategoryInterface $videoCategoryRepository
     */
    public function __construct(VideoCategoryInterface $videoCategoryRepository)
    {
        $this->videoCategoryRepository = $videoCategoryRepository;
    }

    /**
     * @param Request $request
     * @param Video $video
     * @return mixed
     */
    abstract public function execute(Request $request, Video $video);
}
