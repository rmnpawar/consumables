<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $categories = ['Printers', 'Computers', 'UPS', 'Peripherals', 'Cartridges', 'Drums'];

        foreach ($categories as $category) {
            Category::create([
                'cat_name' => $category,
            ]);
        }
    }
}
