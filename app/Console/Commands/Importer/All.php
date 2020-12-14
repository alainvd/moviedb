<?php

namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;

class All extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all';

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
     * @return int
     */
    public function handle()
    {
        $this->call('import:movies');
        $this->call('import:genres');
        $this->call('import:audiences');
    }
}
