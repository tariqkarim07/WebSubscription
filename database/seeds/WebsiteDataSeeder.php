<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Website::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => 'https://google.com',
            ],
            [
                'name' => 'https://cricinfo.com',
            ],
            [
                'name' => 'https://gmail.com',
            ]
        ];

        \App\Website::insert($data);
    }
}
