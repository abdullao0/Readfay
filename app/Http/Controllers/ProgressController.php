<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgressRequest;
use App\Models\Passage;
use App\Models\Progress;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProgressController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $progress = Progress::where('profile_id',$user_id)->get();
        if($user_id != $progress->user_id)
            return response()->json(['message'=>'Unauthraized User'],403);
         
        return response()->json($progress,200);
    }
    public function show($id)
    {
        $user_id = Auth::user()->id;
        if($user_id != $id)
            return response()->json(['message'=>'Unauthraized User'],403);

        $progress = Progress::where('user_id',$id)->firstOrFail();

        return response()->json($progress,200);
    }


    public function store(StoreProgressRequest $request)
    {
        try {
            $user_id = Auth::id();
            $validatedData = $request->validated();

            // get all submitted answers
            // Ensure 'answers' is an array, defaulting to empty if not present
            $answers = $request->input('answers', []); 
            // calculate score using the helper method
            $TestScore = $this->calculateScore($answers);

            $passage = Passage::findOrFail($validatedData['passage_id']);
            
            $words = $passage->numberOfWords;

            // $WPM = $words / ($request->Duration)/60;
            $WPM = $words / ($request->Duration / 60);

            $validatedData['user_id'] = $user_id;
            $validatedData['TestScore'] = $TestScore;
            $validatedData['WPM'] = $WPM;

            Progress::create($validatedData);

            // redirect to profile or results with a success message
            return redirect()->route('profile.get', $user_id)
                     ->with('success', 'Test submitted successfully!')
                     ->with('TestScore', $TestScore);

        } catch (Exception $e) {
    
            return redirect()->route('profile.get', Auth::id())
                    ->with('error', 'Failed to submit test: ' . $e->getMessage());
        }
    }


    // The 'calculateScore' method with null check and loose comparison
    private function calculateScore($answers)
    {
        $score = 0;

        foreach ($answers as $question_id => $user_answer) {
            // Find the question. Use find() which returns null if not found.
            $question = Question::find($question_id);

            // Check if the question was actually found
            if ($question) {
                // Get the correct option text based on CorrectOption value
                // CorrectOption might store "1", "2", "3" or "option1", "option2", "option3" or the actual text
                $correctOptionValue = $question->CorrectOption;
                $correctAnswerText = null;
                
                // Check if CorrectOption is a reference (like "1", "2", "3" or "option1", "option2", "option3")
                $optionNum = preg_replace('/[^0-9]/', '', $correctOptionValue);
                if ($optionNum && in_array($optionNum, ['1', '2', '3'])) {
                    // CorrectOption is a reference, get the actual option text
                    $correctAnswerText = $question->{'option' . $optionNum};
                } else {
                    // CorrectOption stores the actual text directly
                    $correctAnswerText = $correctOptionValue;
                }
                
                // Compare user answer with correct answer text (case-insensitive, trimmed)
                if ($correctAnswerText && trim(strtolower($correctAnswerText)) == trim(strtolower($user_answer))) {
                    $score += 20;
                } else {
                    // Log for debugging
                    Log::debug("Score calculation", [
                        'question_id' => $question_id,
                        'user_answer' => $user_answer,
                        'correct_answer_text' => $correctAnswerText,
                        'correct_option_value' => $correctOptionValue,
                        'match' => false
                    ]);
                }
            } else {
                // Log a warning if a question ID was submitted but not found
                Log::warning("Question ID {$question_id} not found during scoring.");
            }
        }

        return $score;
    }








}
