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
            'first_name' => 'Lawrence',
            'last_name' => 'Righa',
            'email' => 'lawrencierigha@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Dummyguy1',
            'last_name' => 'Righa',
            'email' => 'thisguy1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Dummyguy2',
            'last_name' => 'Righa',
            'email' => 'thisguy2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Dummyguy3',
            'last_name' => 'Righa',
            'email' => 'thisguy3@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
        DB::table('users')->insert([
            'first_name' => 'Dummyguy4',
            'last_name' => 'Righa',
            'email' => 'thisguy4@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);
    }
}
