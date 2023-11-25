<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            OpfSeeder::class,
        ]);

        DB::table('moonshine_users')->insert([
            'moonshine_user_role_id' => 1,
            'email' => 'arttema@mail.ru',
            'password' => Hash::make('1234qwerQWER'),
            'name' => 'arttema',
        ]);
        DB::table('moonshine_users')->insert([
            'moonshine_user_role_id' => 1,
            'email' => 'test@mail.ru',
            'password' => Hash::make('1234qwerQWER'),
            'name' => 'test',
        ]);
        DB::table('moonshine_users')->insert([
            'moonshine_user_role_id' => 1,
            'email' => 'user@mail.ru',
            'password' => Hash::make('1234qwerQWER'),
            'name' => 'user',
        ]);

        $this->call([
            CompanySeeder::class,
            PersonSeeder::class,
        ]);
    }
}
