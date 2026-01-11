<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\ApiUsersSeeder;
use Database\Seeders\ApiPartiesSeeder;
use Database\Seeders\ApiVehiclesSeeder;
use Database\Seeders\ApiCasesSeeder;
use Database\Seeders\ApiInspectionsSeeder;
use Database\Seeders\ApiDocumentsSeeder;

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
        ]);

        
        $this->call([
            ApiCasesSeeder::class,     
        ]);

       
        $this->call([
            ApiInspectionsSeeder::class, 
            ApiDocumentsSeeder::class,  
        ]);

       
    }
}