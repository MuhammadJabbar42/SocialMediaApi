<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WorkQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:work-queue-forever';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the queue worker';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        while (true) {
            $this->call('queue:work', [
                '--sleep' => 3,
                '--tries' => 3,
                '--timeout' => 0
            ]);
            sleep(3);
        }

    }
}
