<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 5; $i++){
            for($j = 0; $j < 10; $j++){
                DB::table('comments')->insert([
                    'created_at' => date("Y-m-d H:i:s", mktime(0,0,0,rand(1, 12),rand(1, 25),2023)),
                    'comment' => Str::random(70),
                    'user_id' => rand(1, 3),
                    'company_id' => $i+1,
                    'field_id' => rand(1, 6),
                ]);
            }
        }
    }
}
