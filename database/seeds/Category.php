<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'общии',
        ]);
        DB::table('categories')->insert([
            'title' => 'ковид',
        ]);
        DB::table('categories')->insert([
            'title' => 'шутки',
        ]);
    }
}
