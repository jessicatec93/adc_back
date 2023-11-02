<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('cat_classifications')->count() == 0){
            $records = [
                [
                    'id'           => 1,
                    'name'         => 'Consumo Básico',
                    'slug'         => 'basic',
                    'active'       => 1,
                    'created_at'   => '2023-10-26T07:00:29+00:00',
                ],
                [
                    'id'           => 2,
                    'name'         => 'Consumo de Impulso',
                    'slug'         => 'impulse',
                    'active'       => 1,
                    'created_at'   => '2023-10-26T07:00:29+00:00',
                ],
                [
                    'id'           => 3,
                    'name'         => 'Consumo de Emergencia',
                    'slug'         => 'emergency',
                    'active'       => 1,
                    'created_at'   => '2023-10-26T07:00:29+00:00',
                ]
            ];
            DB::table('cat_classifications')->insert($records);
        }
    }
}
