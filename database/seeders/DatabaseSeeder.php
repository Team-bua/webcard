<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CardTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
    }
}

class CardTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('discount_types')->insert([
            [
                'name' => 'Cố định',
            ],
        ]);
    }
}

class ProductTypeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('discount_types')->insert([
            [
                'name' => 'Phần trăm',
            ],
        ]);
    }
}

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => '1',
                'name' => 'Admin',
                'email' => 'admin@webcard.com',
                'password' => Hash::make('admin@123'),
            ],
        ]);
    }
}

