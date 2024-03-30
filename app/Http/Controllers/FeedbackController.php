<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showQuestionnaire(Request $request, $set)
    {
        // Previous logic to fetch questionnaire data...
        $questionnaires = [
            [
                'question' => 'What type of app do you want to develop?',
                'options' => ['Telehealth', 'On-demand service marketplace app', 'E-commerce', 'Finance', 'IoT', 'Social network']
            ],
            [
                'question' => 'What is your favorite color?',
                'options' => ['Red', 'Blue', 'Green', 'Yellow', 'Orange']
            ]
            // Add more sets of questions as needed
        ];

        return view('questionnaire', [
            'questionnaire' => $questionnaires[$set - 1],
            'nextSetId' => $set + 1, // Calculate the next set ID
        ]);
    }

    public function saveAnswer(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'question1' => 'required', // Assuming 'question1' is the name of the radio button group
        ]);

        // Store the selected option into the session
        $request->session()->put('selectedOption', $validatedData['question1']);

        // Redirect the user to the next questionnaire set
        return redirect()->route('questionnaire', ['set' => $request->nextSetId]);
    }
}
