<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lawrence',
            'email' => 'lawrencierigha@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);
        DB::table('users')->insert([
            'name' => 'Dummyguy1',
            'email' => 'thisguy1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'name' => 'Dummyguy2',
            'email' => 'thisguy2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'name' => 'Dummyguy3',
            'email' => 'thisguy3@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'name' => 'Dummyguy4',
            'email' => 'thisguy4@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
    }
}
