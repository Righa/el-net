<?php

use Illuminate\Database\Seeder;

class ForumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 5; $i++) { 

        DB::table('forums')->insert([
            'user_id' => '1',
            'subject_id' => '1',
            'question' => 'A good forum question by the forum seeder',
        ]);

        DB::table('forum_answers')->insert([
            'user_id' => $i + 1,
            'forum_id' => '1',
            'answer' => 'A good answer by the forum seeder',
        ]);

        DB::table('votes')->insert([
            'user_id' => $i + 1,
            'forum_answer_id' => '1',
        ]);
        
    	}

    }
}
