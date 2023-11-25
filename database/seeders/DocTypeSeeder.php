<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doc_types')->insert([
            'name' => 'Договор',
        ]);
        DB::table('doc_types')->insert([
            'name' => 'Счет-Договор',
        ]);
        DB::table('doc_types')->insert([
            'name' => 'Счет',
        ]);
        DB::table('doc_types')->insert([
            'name' => 'Акт',
        ]);
    }
}
