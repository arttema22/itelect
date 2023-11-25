<?php

namespace Database\Seeders;

use App\Models\Contacts\Address;
use App\Models\Contacts\Bank;
use App\Models\Contacts\Company;
use App\Models\Contacts\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory(15)
            ->has(Address::factory()->count(2))
            ->has(Bank::factory()->count(2))
            ->create();
    }
}
