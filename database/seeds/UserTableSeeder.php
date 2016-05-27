<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\CursoCode\Entities\User::class)->create([
            'name' => 'Bruno',
            'email' => 'brunu.neves@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(\CursoCode\Entities\User::class, 10)->create();
    }
}
