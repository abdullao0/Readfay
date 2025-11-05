<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassageRequest;
use App\Http\Requests\UpdatePassageRequest;
use App\Models\Passage;
use Exception;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassageController extends Controller
{
    public function index()
    {
        try {
        $user_id = Auth::user()->id;
        $passages = Passage::all() ?? collect();;
        return view('templates.index',compact('passages','user_id'));
        } catch (Exception $e) {

        $passages = Passage::all() ?? collect();;
        return view('templates.index',compact('passages'));
        }

    }
    public function show($id)
    {
        
        $passage = Passage::findOrFail($id);
        return view('templates.passage',compact('passage'));
    }
    public function store(StorePassageRequest $request)
    {
        $validatedData = $request->validated();
        $passage = Passage::create($validatedData);
        

        return response()->json($passage,201);
    }
    public function update(UpdatePassageRequest $request,$id)
    {

        $passage = Passage::findOrFail($id);
        $passage->update($request->validated());
        return response()->json($passage,200);
    }

    public function destroy($id)
    {

        $passage = Passage::findOrFail($id);
        $passage->delete();
        return response()->json([
            'message'=>'passage deleted successfully'
        ],200);
    }
}
