<?php

use Illuminate\Database\Seeder;

class ExamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $we = $i+1;

        DB::table('exams')->insert([
            'course_id' => '1',
            'name' => 'Good exam',
            'duration' => '60',
            'password' => 'password',
        ]);

        DB::table('materials')->insert([
            'course_id' => '1',
            'topic_id' => $i+1,
            'name' => 'QUIZ'.(string)$we,
            'type' => 'exam',
            'source' => (string)$we,
        ]);

        DB::table('exam_questions')->insert([
            'exam_id' => '1',
            'number' => $i + 1,
            'question' => 'Good question made by exam seeder',
            'choice1' => 'fisrt option',
            'choice2' => 'second option',
            'choice3' => 'third option',
            'choice4' => 'fourth option',
            'marks' => '2',
            'correct' => 'choice3',
        ]);

        DB::table('takes')->insert([
            'user_id' => '1',
            'exam_id' => $i + 1,
        ]);


        DB::table('exam_answers')->insert([
            'take_id' => '1',
            'exam_question_id' => $i + 1,
            'choice' => 'choice3',
            'marks' => '2'
        ]);

        }
    }
}
