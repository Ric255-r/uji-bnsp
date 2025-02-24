<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan make:seeder ProdukSeeder
        // lalu isi valuenya manual
        Produk::insert([
            ['thumbnail' => 'assets/thumbnail/samsung.jpg', 'produk' => 'Samsung S24 Ultra', 'kategori' => 'Samsung', 'harga' => 19000000, 'created_at' => now(), 'updated_at' => now()],
            ['thumbnail' => 'assets/thumbnail/iphone.jpg', 'produk' => 'Iphone 15 Pro Max', 'kategori' => 'Iphone', 'harga' => 25000000, 'created_at' => now(), 'updated_at' => now()],
            ['thumbnail' => 'assets/thumbnail/xiaomi.jpg', 'produk' => 'Xiaomi 14T', 'kategori' => 'Xiaomi', 'harga' => 10000000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
