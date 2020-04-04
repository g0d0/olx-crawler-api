<?php

namespace App\Console\Commands;

use App\Olx\States;
use Illuminate\Console\Command;

class OlxStatesSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'olx:sync:states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync states';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(States $service)
    {
        $this->info('Sync states started');
        $service->sync();
        $this->info('Sync states finished');
    }
}
