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
        \CursoCode\Entities\Client::truncate();
        factory(\CursoCode\Entities\Client::class, 10)->create();
    }
}
