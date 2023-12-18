<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //Get all questions and send it to the client
    public function getQuestions(){
        $questions = Question::all();
        return response()->json($questions);
    }
}
