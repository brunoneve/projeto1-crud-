<?php

use Illuminate\Database\Seeder;


class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CursoCode\Client::truncate();
        factory(\CursoCode\Client::class, 10)->create();
    }
}
