<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'price' => 99.99,
                'category' => 'Software',
                'attributes' => json_encode(['license' => 'single-user', 'platform' => 'Windows']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Product 2',
                'price' => 199.99,
                'category' => 'E-book',
                'attributes' => json_encode(['format' => 'PDF', 'pages' => 250]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Product 3',
                'price' => 49.99,
                'category' => 'Music',
                'attributes' => json_encode(['bitrate' => '320kbps', 'format' => 'MP3']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Product 4',
                'price' => 29.99,
                'category' => 'Course',
                'attributes' => json_encode(['duration' => '10 hours', 'level' => 'beginner']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Product 5',
                'price' => 149.99,
                'category' => 'SaaS Subscription',
                'attributes' => json_encode(['plan' => 'Pro', 'billing_cycle' => 'monthly']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
