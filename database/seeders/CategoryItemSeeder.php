<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryItem;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk konsistensi
        DB::table('categories_item')->delete();

        $categories = [
            [
                'name' => 'Karbohidrat Dasar',
                'description' => 'Pilihan sumber karbohidrat utama untuk Custom Bowl atau Wrap Anda.',
            ],
            [
                'name' => 'Pilihan Roti',
                'description' => 'Pilihan jenis roti untuk Burger atau Sandwich.',
            ],
            [
                'name' => 'Pilihan Protein',
                'description' => 'Sumber protein utama, dari hewani hingga nabati.',
            ],
            [
                'name' => 'Sayuran Segar',
                'description' => 'Berbagai macam sayuran segar untuk menambah vitamin dan serat.',
            ],
            [
                'name' => 'Topping & Pelengkap',
                'description' => 'Item tambahan untuk memperkaya rasa dan tekstur makanan Anda.',
            ],
            [
                'name' => 'Saus & Dressing',
                'description' => 'Pilihan saus untuk menyempurnakan cita rasa hidangan.',
            ],
        ];

        // Tambahkan timestamp untuk setiap item sebelum insert
        $timestamp = now();
        foreach ($categories as &$category) {
            $category['created_at'] = $timestamp;
            $category['updated_at'] = $timestamp;
        }

        // Insert data ke database menggunakan mass assignment dari model
        // Ini lebih aman dan mengikuti praktik Eloquent
        DB::table('categories_item')->insert($categories);
    }
}
