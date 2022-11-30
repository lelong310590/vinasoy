<?php
/**
 * ImportMemberCommand.php
 * Created by: trainheartnet
 * Created at: 30/11/2022
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\Member\Commands;

use Botble\Member\Imports\ImportMember;
use Illuminate\Console\Command;

class ImportMemberCommand extends Command
{
    protected $signature = 'import:excel';

    protected $description = 'Laravel Excel importer';

    public function handle()
    {
        $this->output->title('Starting import');
        (new ImportMember)->withOutput($this->output)->import(public_path().'/sheet.xlsx');
        $this->output->success('Import successful');
    }
}
