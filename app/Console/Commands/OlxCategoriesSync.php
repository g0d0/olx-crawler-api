<?php

namespace App\Console\Commands;

use App\Olx\Categories;
use Illuminate\Console\Command;

class OlxCategoriesSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'olx:sync:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync categories';

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
    public function handle(Categories $service)
    {
        $this->info('Sync categories started');
        $service->sync();
        $this->info('Sync categories finished');
    }
}
