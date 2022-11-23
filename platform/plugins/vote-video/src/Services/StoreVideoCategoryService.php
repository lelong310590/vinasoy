<?php
/**
 * StoreVideoCategoryService.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Services;

use Botble\VideoVoting\Models\Video;
use Botble\VideoVoting\Services\Abstracts\StoreVideoCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreVideoCategoryService extends StoreVideoCategoryServiceAbstract
{
    /**
     * @param Request $request
     * @param Video $post
     * @return mixed|void
     */
    public function execute(Request $request, Video $post)
    {
        $categories = $request->input('categories');
        if (!empty($categories) && is_array($categories)) {
            $post->categories()->sync($categories);
        }
    }
}
