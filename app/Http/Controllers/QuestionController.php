<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions(){
        $questions = Question::all();
        return response()->json($questions);
    }
}
