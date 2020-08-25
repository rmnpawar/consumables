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
    }
}
