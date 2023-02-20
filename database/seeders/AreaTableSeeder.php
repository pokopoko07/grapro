<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'area' => '柏市',
        ];
        DB::table('areas')->insert($param);

        $param=[
            'area' => '千葉（柏市を除く）',
        ];
        DB::table('areas')->insert($param);

        $param=[
            'area' => '茨城',
        ];
        DB::table('areas')->insert($param);

        $param=[
            'area' => '東京',
        ];
        DB::table('areas')->insert($param);

        $param=[
            'area' => '埼玉',
        ];
        DB::table('areas')->insert($param);

        $param=[
            'area' => 'その他',
        ];
        DB::table('areas')->insert($param);
    }
}
