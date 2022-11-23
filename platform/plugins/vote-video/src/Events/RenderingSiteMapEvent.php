<?php
/**
 * RenderingSiteMapEvent.php
 * Created by: trainheartnet
 * Created at: 23/12/2021
 * Contact me at: longlengoc90@gmail.com
 */

namespace Botble\VideoVoting\Events;

use Botble\Base\Events\Event;
use Illuminate\Queue\SerializesModels;

class RenderingSiteMapEvent extends Event
{
    use SerializesModels;
}
