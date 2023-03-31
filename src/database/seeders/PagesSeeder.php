<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'title' => 'Main',
                'slug' => 'main'
            ], [
                'title' => 'Investitions',
                'slug' => 'investitions'
            ], [
                'title' => 'Our projects',
                'slug' => 'our-projects'
            ], [
                'title' => 'Work with us',
                'slug' => 'Work-with-us'
            ]
        ]);
        DB::table('investments')->insert([
            [
                'title' => 'default',
                'description' => 'default',
                'image_desc' => 'default',
            ]
        ]);
    }
}
