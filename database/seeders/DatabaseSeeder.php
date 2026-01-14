<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\ApiUsersSeeder;
use Database\Seeders\ApiPartiesSeeder;
use Database\Seeders\ApiVehiclesSeeder;
use Database\Seeders\ApiCasesSeeder;
use Database\Seeders\ApiInspectionsSeeder;
use Database\Seeders\ApiDocumentsSeeder;
use Database\Seeders\ApiTotalSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =======================================================
        // 1. Seed Independent Entities (Parents)
        // These tables do not rely on any other primary records.
        // =======================================================
        $this->call([
            ApiUsersSeeder::class,    
            ApiPartiesSeeder::class,   
            ApiVehiclesSeeder::class,
            ApiCasesSeeder::class,
            ApiInspectionsSeeder::class, 
            ApiDocumentsSeeder::class,
            ApiTotalSeeder::class,
        ]);

        
        $this->call([
                
        ]);

       
        $this->call([
             
        ]);

       
    }
}