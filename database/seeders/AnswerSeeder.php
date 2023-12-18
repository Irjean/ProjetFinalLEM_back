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
            //Generate a random email until it's not used
            $profile_email = Str::random(10).'@gmail.com';
            $randProfile = Profile::where("email", $profile_email)->first();
            while($randProfile !== null){
                $profile_email = Str::random(10).'@gmail.com';
                $randProfile = Profile::where("email", $profile_email)->first();
            }
            //Generate a random UID until it's not used
            $randUid = Str::random(10);
            $randUidProfile = Profile::where("uid", $randUid)->first();
            while($randUidProfile !== null){
                $randUid = Str::random(10);
                $randUidProfile = Profile::where("uid", $randUid)->first();
            }
            //Create a profile with the unused email and UID
            $profile = new Profile([
                "email"=>$profile_email,
                "uid"=>$randUid
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
                        if($question->id == 1){
                            $content = Str::random(10)."@gmail.com";
                            break;
                        } else if($question->id == 2){
                            $content = rand(10, 100);
                            break;
                        } else {
                            $content = Str::random(10);
                            break;
                        }
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
