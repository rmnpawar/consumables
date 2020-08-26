<?php

use App\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::truncate();

        $com = ['Server', 'Laptop', 'Desktop'];
        $printer = ['LaserJet', 'Inkjet', 'InkTank', 'All-In-One'];
        $cart = ['12A', '36A', '88A', 'TN-2365', 'TN-2280'];
        $drums = ['DR-2365', 'DR-2255'];
        $peri = ['Keyboard', 'Mouse', 'Pen Drive', 'WebCam'];


        foreach ($com as $value) {
            SubCategory::create([
                'category' => 'Computers',
                'name' => $value,
            ]);
        }

        foreach ($printer as $value) {
            SubCategory::create([
                'category' => 'Printers',
                'name' => $value,
            ]);
        }
        foreach ($cart as $value) {
            SubCategory::create([
                'category' => 'Cartridges',
                'name' => $value,
            ]);
        }
        foreach ($drums as $value) {
            SubCategory::create([
                'category' => 'Drums',
                'name' => $value,
            ]);
        }

        foreach ($peri as $value) {
            SubCategory::create([
                'category' => 'Peripherals',
                'name' => $value,
            ]);
        }
    }
}
