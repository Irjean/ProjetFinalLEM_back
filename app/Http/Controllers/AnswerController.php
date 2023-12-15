<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    public function getAllAnswers(){
        $answers = Answer::all();
        return response()->json($answers);
    }


    public function getOneAnswer($id){
        $profile = Profile::where("uid", $id)->first();
        $answers = Answer::where("profile_id", $profile->id)->get();
        
        return response()->json($answers);
    }

    public function postAnswers(Request $request)
    {
        try {
            $submittedAnswers = $request->all();
            $arr = $submittedAnswers["answers"];

                $profile = new Profile();


            foreach ($arr as $submittedAnswer) {
                if($submittedAnswer["question_id"] == "1"){
                    $profile->email = $submittedAnswer["answer"];
                    $profile->uid = Str::random(10);

                    $profile->save();
                }

                $answer = new Answer();
                $answer->content = $submittedAnswer['answer'];
                $answer->question_id = $submittedAnswer['question_id'];
                $answer->profile_id = $profile->id;

                $answer->save();
            }
            return response()->json(['message' => 'Réponses soumises avec succès', "profile" => $profile]);
        } catch (\Exception) {
            return response()->json(['error' => 'Erreur lors de la soumission des réponses'],500);
        }

    }

}
