<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// ---------------------------------------------
// ADDED: Use statements for all API Seeders
// ---------------------------------------------
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
            ApiUsersSeeder::class,     // Users (required for assigned_to and uploaded_by)
            ApiPartiesSeeder::class,   // Parties (required for consignee_id/declarant_id in Cases)
            ApiVehiclesSeeder::class,  // Vehicles (required for vehicle_id in Cases)
        ]);

        
        $this->call([
            ApiCasesSeeder::class,     // Cases (requires Users, Parties, Vehicles)
        ]);

       
        $this->call([
            ApiInspectionsSeeder::class, // Inspections (requires Cases)
            ApiDocumentsSeeder::class,   // Documents (requires Cases and Users)
        ]);

       
    }
}