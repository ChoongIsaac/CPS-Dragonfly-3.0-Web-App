<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read data from JSON file
        $json = File::get(database_path('seeders/items.json'));
        $data = json_decode($json, true);

        // Seed the items table
        foreach ($data as $item) {
            DB::table('items')->insert($item);
        }
    }
}
