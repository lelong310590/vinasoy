<?php
/**
 * RenderingSiteMapListener.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

namespace Botble\VideoVoting\Listeners;

use Botble\VideoVoting\Repositories\Eloquent\VideoCategoryRepository;
use Botble\VideoVoting\Repositories\Eloquent\VideoRepository;
use SiteMapManager;

class RenderingSiteMapListener
{
    /**
     * @var VideoCategoryRepository
     */
    protected $videoCategoryRepository;

    /**
     * @var
     */
    protected $videoRepository;

    /**
     * RenderingSiteMapListener constructor.
     * @param VideoCategoryRepository $videoCategoryRepository
     */
    public function __construct(
        VideoCategoryRepository $videoCategoryRepository,
        VideoRepository $videoRepository
    ) {
        $this->videoCategoryRepository = $videoCategoryRepository;
        $this->videoRepository = $videoRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $videoCategory = $this->videoCategoryRepository->getDataSiteMap();

        foreach ($videoCategory as $category) {
            SiteMapManager::add($category->url, $category->updated_at, '0.8');
        }

        $videos = $this->videoRepository->getDataSiteMap();

        foreach ($videos as $video) {
            SiteMapManager::add($video->url, $video->updated_at, '0.8');
        }
    }
}
