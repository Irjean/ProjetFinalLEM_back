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
        $count = 0;
        while($count < 30){
            $questions = Question::all();

            $profile_email = Str::random(10).'@gmail.com';
            $profile = new Profile([
                "email"=>$profile_email,
                "uid"=>Str::random(10)
            ]);

            $profile->save();

            foreach($questions as $question){
                switch($question->type){
                    case "A":
                        $arr = json_decode($question->choices);
                        $content = $arr[rand(0, count($arr) - 1)];
                        break;
                    case "B": 
                        $content = Str::random(10);
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
