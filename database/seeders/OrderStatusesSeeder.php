<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('cat_order_statuses')->count() == 0){
            $records = [
                [
                    'id'           => 1,
                    'name'         => 'solicitado',
                    'slug'         => 'required',
                    'active'       => 1,
                    'created_at'   => '2023-11-02T07:00:29+00:00',
                ],
                [
                    'id'           => 2,
                    'name'         => 'recibido',
                    'slug'         => 'received',
                    'active'       => 1,
                    'created_at'   => '2023-11-02T07:00:29+00:00',
                ],
                [
                    'id'           => 3,
                    'name'         => 'rechazado',
                    'slug'         => 'refused',
                    'active'       => 1,
                    'created_at'   => '2023-11-02T07:00:29+00:00',
                ],
                [
                    'id'           => 4,
                    'name'         => 'procesando',
                    'slug'         => 'processing',
                    'active'       => 1,
                    'created_at'   => '2023-11-02T07:00:29+00:00',
                ],
                [
                    'id'           => 5,
                    'name'         => 'finalizado',
                    'slug'         => 'finalized',
                    'active'       => 1,
                    'created_at'   => '2023-11-02T07:00:29+00:00',
                ]
            ];
            DB::table('cat_order_statuses')->insert($records);
        }
    }
}
