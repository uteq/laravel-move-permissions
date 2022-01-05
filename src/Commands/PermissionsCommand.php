<?php

namespace Uteq\MovePermissions\Commands;

use Illuminate\Console\Command;

class PermissionsCommand extends Command
{
    public $signature = 'move-permissions';

    public $description = 'My command';

    public function handle(): void
    {
        $this->comment('All done');
    }
}
