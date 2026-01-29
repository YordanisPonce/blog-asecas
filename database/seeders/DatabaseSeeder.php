<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ApplicationSeeder::class,
            FinishSeeder::class,
            InspirationSeeder::class,
            SpacesSeeder::class,
            HomeSeeder::class,
            BuildersArchitectsPageSeeder::class,
            ApplicatorsPageSeeder::class,
            IntegralProjectsPageSeeder::class,
            CertificationsDocumentationPageSeeder::class,
            ContactPageSeeder::class,
            WorkWithUsPageSeeder::class,
        ]);
    }
}