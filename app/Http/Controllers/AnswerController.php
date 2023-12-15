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

    public function getOneAnswer($id){
        $profile = Profile::where("uid", $id)->first();
        $answers = Answer::where("profile_id", $profile->id)->get();
        
        return response()->json($answers);
    }
}
