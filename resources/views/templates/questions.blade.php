@extends('templates.base')

@section('title', 'Questions')

@section('content')


<section class="quiz-section container">
    <div class="quiz-header">
        <h2>Done With The Reading?</h2>
        <p>Answer the following questions to evaluate your comprehension accuracy.</p>
    </div>

            

<form method="post" action=" {{ route('store.progress') }}" >
    @csrf
    @foreach ($questions as $question)
        <div class="question-block">
            <p>{{ $question->question }}</p>
            <div class="options">
                <div>
                    <input type="radio" id="q{{ $question->id }}_1" name="answers[{{ $question->id }}]" value="{{ $question->option1 }}" required>
                    <label for="q{{ $question->id }}_1">{{ $question->option1 }}</label>
                </div>

                <div>
                    <input type="radio" id="q{{ $question->id }}_2" name="answers[{{ $question->id }}]" value="{{ $question->option2 }}">
                    <label for="q{{ $question->id }}_2">{{ $question->option2 }}</label>
                </div>

                <div>
                    <input type="radio" id="q{{ $question->id }}_3" name="answers[{{ $question->id }}]" value="{{ $question->option3 }}">
                    <label for="q{{ $question->id }}_3">{{ $question->option3 }}</label>
                </div>
            </div>
        </div>
    @endforeach
                <input type="hidden" name="passage_id" value="{{ $questions->first()->passage_id }}">
                <input type="hidden" name="Duration" value="{{ $Duration }}">


    <div class="form-actions">
        <button onclick="style.display = 'none' " type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

</section>

@endsection