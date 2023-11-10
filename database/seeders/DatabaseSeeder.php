<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Mota Suren',
            'price' => 15000,
            'image' => 'motasuren.jpg',
            'description' => 'kopi dan susu',
            'type' => 'coffee',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
