<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::insert([
            [
                'description' => 'ATIVO',
                'created_at'  => '2020-01-01 08:33:00',
                'updated_at'  => '2020-01-01 08:33:00'
            ],
            [
                'description' => 'INATIVO',
                'created_at'  => '2020-01-01 08:33:00',
                'updated_at'  => '2020-01-01 08:33:00'
            ],
            [
                'description' => 'PENDENTE',
                'created_at'  => '2020-01-01 08:33:00',
                'updated_at'  => '2020-01-01 08:33:00'
            ],
            [
                'description' => 'EXCLUIDO',
                'created_at'  => '2020-01-01 08:33:00',
                'updated_at'  => '2020-01-01 08:33:00'
            ]
        ]);
    }
}