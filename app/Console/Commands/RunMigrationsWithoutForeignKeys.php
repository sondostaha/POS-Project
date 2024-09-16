<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunMigrationsWithoutForeignKeys extends Command
{

    protected $signature = 'migrate:without-foreign-keys {--seed : Seed the database after migrating}';
    protected $description = 'Run all migrations without checking foreign keys.';

    public function handle()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Run migrations
        $this->call('migrate');

        // Seed the database if the --seed option is provided
        if ($this->option('seed')) {
            $this->call('db:seed');
        }

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('All migrations ran without checking foreign keys.');

        // Display message if seeding is done
        if ($this->option('seed')) {
            $this->info('Database seeded successfully.');
        }
    }
}
