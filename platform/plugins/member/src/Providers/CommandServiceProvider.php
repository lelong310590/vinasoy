<?php
/**
 * CommandServiceProvider.php
 * Created by: trainheartnet
 * Created at: 30/11/2022
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\Member\Providers;

use Botble\Member\Commands\ImportMemberCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportMemberCommand::class,
            ]);
        }
    }
}
