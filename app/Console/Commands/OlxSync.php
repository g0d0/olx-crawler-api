<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OlxSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'olx:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data';

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
    public function handle()
    {
        $this->call(OlxCategoriesSync::class);
        $this->call(OlxStatesSync::class);
    }
}
