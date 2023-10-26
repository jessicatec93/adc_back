<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('users')->count() == 0){
            $records = [
                [
                    'id'            => 1,
                    'name'          => 'Jose Almenarez',
                    'email'         => 'admin@hotmail.com',
                    'password'      => '$2a$12$0h6N9D95AdzR8NJC01djSepD7RKlAKatlQ/oHeleLoIgqBZRh1KLC',
                    'created_at'    => '2023-10-26T07:00:29+00:00',
                ],
            ];
            DB::table('users')->insert($records);
        }
    }
}
