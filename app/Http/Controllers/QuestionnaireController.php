<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionnaireResponse;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $questions = [
            'What type of app do you want to develop?',
            'What is your favorite animal?',
            // Add more questions here
        ];

        return view('questionnaire', compact('questions'));
    }


    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            // Add validation rules for questionnaire answers here
        ]);

        QuestionnaireResponse::create($validatedData);

        return response()->json(['message' => 'Questionnaire submitted successfully']);
    }

    public function getQuestion($questionNumber)
    {
        $questions = [
            'What type of app do you want to develop?',
            'What is your favorite animal?',
            // Add more questions here
        ];

        $question = isset($questions[$questionNumber - 1]) ? $questions[$questionNumber - 1] : null;

        if (!$question) {
            return response()->json(['message' => 'No more questions']);
        }

        return response()->json(['question' => $question]);
    }



}