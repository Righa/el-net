<?php

use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 5; $i++) { 

        DB::table('subjects')->insert([
            'name' => 'Good subject',
            'description' => 'Another good subject created by subjects seeder',
        ]);
        
    	}
    }
}
