<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Fund;
use App\Models\FundAlias;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Fund::factory()
            ->has(FundAlias::factory()->count(5), 'aliases')
            ->has(Company::factory()->count(5), 'companies')
            ->count(20)
            ->create();
    }
}
