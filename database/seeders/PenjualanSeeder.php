<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Penjualan;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan make:seeder PenjualanSeeder

        // tarik semua product id
        $produkId = Produk::pluck('id')->toArray();

        // insert dummy data dengan random product id
        for ($i=1; $i <= 10; $i++) { 
            Penjualan::insert([
                'id_produk' => $produkId[array_rand($produkId)],  // random pilih product ID
                'tgl_jual' => Carbon::create(2025, 01, rand(1, 30)),
                // 'tgl_jual' => now()->subDays(rand(1, 30)), // range dari sekarang lalu mundur max 30 hr ke blkg
                'created_at'=> now(),
                'updated_at' => now()
            ]);
        }
    }
}
