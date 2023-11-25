<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('opfs')->insert([
            'short' => 'ООО',
            'full' => 'Общество с ограниченной ответственностью',
        ]);
        DB::table('opfs')->insert([
            'short' => 'ИП',
            'full' => 'Индивидуаольный предприниматель',
        ]);
        DB::table('opfs')->insert([
            'short' => 'АО',
            'full' => 'Акционерное общество',
        ]);
    }
}
