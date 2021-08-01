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
        DB::table('card_types')->insert([
            [
                'name' => 'Card',
            ],
        ]);
    }
}

class ProductTypeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('card_types')->insert([
            [
                'name' => 'Voucher',
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

class TransactionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_transaction')->insert([
            [
                'transaction_type' => 'bank',
            ],
        ]);
    }
}
