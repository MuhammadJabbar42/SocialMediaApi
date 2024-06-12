<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Your Database';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Define the filename for the backup file
        $fileName = 'backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';

        // Define the storage path
        $storagePath = storage_path('app/backup/' . $fileName);

        // Get the database connection details
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Construct the command to execute the backup
        $command = "\"C:\\xampp\\mysql\\bin\\mysqldump\" --user={$dbUser} --password={$dbPassword} --host={$dbHost} {$dbName} > {$storagePath}";

        // Execute the command
        $result = null;
        $output = null;
        exec($command, $output, $result);

        // Check if the command was successful
        if ($result === 0) {
            $this->info('The backup has been completed successfully.');
        } else {
            $this->error('An error occurred while creating the backup.');
        }
    }        
}

