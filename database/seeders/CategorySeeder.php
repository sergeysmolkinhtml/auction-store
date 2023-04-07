<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        for($i = 0;$i <= 11; $i++){
            $cName = "Category #" . $i;

            $categories[] = [
                'name'     => $cName,
            ];
        }

        DB::table('categories')->insert($categories);

    }
}
