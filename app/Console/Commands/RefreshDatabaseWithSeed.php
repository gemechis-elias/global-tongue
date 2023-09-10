<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabaseWithSeed extends Command
{
    protected $signature = 'database:refresh-with-seed';

    protected $description = 'Refresh the database without deleting existing data and seed it.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Migrate the database without rolling back
        Artisan::call('migrate', [
            '--path' => 'database/migrations',
        ]);

        // Seed the database
        Artisan::call('db:seed');

        $this->info('Database refreshed with seeding.');
    }
}
