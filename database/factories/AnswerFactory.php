<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
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
                    $content = Str::random(10);
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
    }
}
