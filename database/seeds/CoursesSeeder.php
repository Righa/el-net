<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 5; $i++) { 
    		
        DB::table('courses')->insert([
            'subject_id' => '1',
            'teacher_id' => '1',
            'name' => 'Good course',
            'description' => 'Auto generated course by courses seeder',
            'password' => 'password',
        ]);

        DB::table('topics')->insert([
            'course_id' => '1',
            'name' => 'Good topic',
        ]);

        DB::table('registered_courses')->insert([
            'course_id' => '1',
            'user_id' => $i + 1,
        ]);

    	}
    }
}
