<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get questions from a json file
        $surveyString = file_get_contents("./survey.json");
        $surveyJson = json_decode($surveyString, true);
        //Create a survey
        DB::table("surveys")->insert([
            "id" => 1
        ]);
        $surveyTable = DB::table("surveys")->first();
        
        $surveyArray = $surveyJson["questions"];

        
        //Fill the question table with the questions from the json file
        foreach($surveyArray as $question){
            if(array_key_exists("choices", $question)){
                DB::table("questions")->insert([
                    "content" => $question["question"],
                    "type" => $question["type"],
                    "choices" => json_encode($question["choices"]),
                    "survey_id" => $surveyTable->id
                ]);
            } else {
                DB::table("questions")->insert([
                    "content" => $question["question"],
                    "type" => $question["type"],
                    "survey_id" => $surveyTable->id
                ]);
            }
        };
    }
}
