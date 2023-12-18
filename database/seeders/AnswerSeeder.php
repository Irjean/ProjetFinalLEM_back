<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Seed 30 profiles with answers
        $count = 0;
        while($count < 30){
            //get the existing questions
            $questions = Question::all();
            //create a profile
            $profile_email = Str::random(10).'@gmail.com';
            $profile = new Profile([
                "email"=>$profile_email,
                "uid"=>Str::random(10)
            ]);

            $profile->save();
            //generate a random answer for each question and link it to the profile
            foreach($questions as $question){
                switch($question->type){
                    case "A":
                        $arr = json_decode($question->choices);
                        $content = $arr[rand(0, count($arr) - 1)];
                        break;
                    case "B": 
                        $question->id == 1 ? $content = Str::random(10)."@gmail.com" : $content = Str::random(10);
                        break;
                    case "C":
                        $content = rand(1, 5);
                        break;
                }

                DB::table("answers")->insert([
                    "content" => $content,
                    "question_id" => $question->id,
                    "profile_id" => $profile->id
                ]);
            };
            $count++;
        };
    }
}
