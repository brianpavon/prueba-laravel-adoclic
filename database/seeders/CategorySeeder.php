<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimino los registros existentes en la tabla de categorías
        Category::truncate();

        // Inserto las categorías "Animals" y "Security"
        Category::create(['category' => 'Animals']);
        Category::create(['category' => 'Security']);
    }
}
