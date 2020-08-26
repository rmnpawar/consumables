<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Hp', 'Brother', 'Dell', 'Lenovo', 'Luminuous', 'Kingston', 'SanDisk'];

        foreach ($brands as $value) {
            Brand::create([
                'name' => $value,
            ]);
        }
    }
}
