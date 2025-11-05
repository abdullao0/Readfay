<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Passage;
use App\Models\Question;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class QuestionController extends Controller
{
        public function index()
    {
        $questions = Question::all();
        return response()->json($questions,200);
    }
    public function show(Request $request,$id)
    {
        $questions = Question::where('passage_id', $id)->get();

        if ($questions->isEmpty()) {
            return redirect('/passage')->with('error', 'No questions found for this passage.');
        }
        $Duration = $request->query('Duration');
        return view('templates.questions', compact('questions','Duration'));
    }
    public function store(StoreQuestionRequest $request,$passage_id)
    {
        $validatedDate = $request->validated();
        $validatedDate['passage_id'] =$passage_id;
        $question = Question::create($validatedDate);
        return response()->json($question,201);
    }
    public function update(UpdateQuestionRequest $request,$id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->validated());
        return response()->json($question,200);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json([
            'message'=>'question deleted successfully'
        ],200);
    }
}
