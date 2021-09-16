<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = ['Admin', 'Estt.', 'Coordination', 'Report', 'DRAC'];

        foreach ($section as $sec) {
            Section::create([
                'section_name' => $sec,
            ]);
        }
    }
}
