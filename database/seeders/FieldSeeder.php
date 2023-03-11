<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(['name', 'INN', 'gen_desc', 'director', 'address', 'number'] as $fieldName){
        DB::table('fields')->insert([
            'field'=> $fieldName,
        ]);
    }
        
    }
}
