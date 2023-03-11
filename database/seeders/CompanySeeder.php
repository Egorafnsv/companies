<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Integer;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 5; $i++){
            $inn = '';
            for($j = 0; $j < 10; $j++) $inn .= rand(0, 9);

            DB::table('companies')->insert([
                'name' => Str::random(7),
                'INN' => $inn,
                'gen_desc' => Str::random(70),
                'director' => Str::random(5).' '.Str::random(5),
                'address' => Str::random(10),
                'number' => '+79000000000'
            ]);
        }
    }
}
