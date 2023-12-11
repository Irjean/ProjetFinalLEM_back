<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Profile;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function getAnswers(){
        $answers = Answer::all();
        return response()->json($answers);
    }

    public function postAnswers(Request $request)
    {
        try {
            $submittedAnswers = $request->input('answers');

            foreach ($submittedAnswers as $submittedAnswer) {
                $answer = new Answer();
                $answer->content = $submittedAnswer['content'];
                $answer->question_id = $submittedAnswer['questionId'];
                $answer->profile_id = $this->getprofileId($request);

                $answer->save();
            }
            return response()->json(['message' => 'Réponses soumises avec succès']);
        } catch (\Exception) {
            return response()->json(['error' => 'Erreur lors de la soumission des réponses'],500);
        }

    }
    private function getProfileId(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $profile = Profile::where('uid', $user->id)->first();

            if ($profile) {
                return $profile->id;
            }
        }

        return null;
    }
}
