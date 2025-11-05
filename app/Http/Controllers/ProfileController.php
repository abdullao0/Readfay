<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Passage;
use App\Models\Profile;
use App\Models\Progress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user_role = Auth::user()->role;
        $profiles = Profile::all();
        if ($user_role != 'admin')
            return response()->json(['message' => 'Unauthraized User'], 403);

        return response()->json($profiles);
    }

    public function show($id)
    {
        try {
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $id)->firstOrFail();
        if ($user_id != $profile->user_id)
            return response()->json(['message' => 'Unauthraized User'], 403);
        
        $progress = Progress::where('user_id', $id)->get() ?? collect();

        return view('templates.profile', compact('profile'))->with(['progress' => $progress]);

        } catch (Exception $e) {

            return redirect()->route('index')->with('error', 'Please log in first.');
        }

    }


    public function store(StoreProfileRequest $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('profiles', 'public');
        } 
        else {
            $validatedData['image'] = 'defaults/default.jpeg';
        }
        $profile = Profile::create($validatedData);
        return view('templates.profile',compact('profile'));
    }


    public function editProfile($user_id){
        
        
        $profile = Profile::where('user_id',$user_id)->firstOrFail();
        return view('templates.updateProfile', compact('profile'))->with('user_id',$user_id);
    }
    public function update(UpdateProfileRequest $request, $id)
    {
        try {
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $id)->firstOrFail();
        if ($user_id != $profile->user_id)
            return response()->json(['message' => 'Unauthraized User'], 403);

        // $profile = Profile::update($request->validated());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $profile['image'] = $path;
        } 
        else {
            $profile['image'] = 'defaults/default.jpeg';
        }
        $profile = $profile->update($request->validated());

        return redirect()->route('index')->with('ok', 'Profile Updated.');
        } 
        catch (Exception $e) {
            return $e;
        }

    }
}
