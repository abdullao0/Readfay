@extends('templates.base')

@section('title', 'Update Profile')

@section('content')

    <div class="container mx-auto max-w-md p-6 bg-white shadow rounded">
        <h2 class="text-2xl font-bold mb-4 text-center">Update Your Profile</h2>
        <form action="{{ route('profile.update', $user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  {{-- This spoofs a PUT request --}}
            <div class="mb-3">
                <label class="block font-semibold">Date Of Birth</label>
                <input type="date" name="DOB" class="w-full border rounded p-2" value="{{ old('DOB', $profile->DOB ?? '') }}">
                @error('DOB')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold">Bio</label>
                <textarea name="bio" class="w-full border rounded p-2">{{ old('bio', $profile->bio ?? '') }}</textarea>
                @error('bio')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Profile image (png,jpg,jpeg)</label>
                <input id="image" type="file" name="image" class="form-input">
                @error('image')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button onclick="style.display = 'none' " type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full hover:bg-blue-700">Update
                Profile</button>
        </form>
    </div>

@endsection