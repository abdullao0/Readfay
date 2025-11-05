@extends('templates.base')

@section('title','passage')

@section('content')

@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif

    <div class="title-header">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <button class="turn">Start Reading</button>
            <div id="timer" style="font-size: 1.2rem; font-weight: bold; color: #333; min-width: 80px; text-align: right;">
                0s
            </div>
        </div>
        
        <div class="title-info-main">
            <h1 class="title-name">{{$passage->title}}</h1>
            <div class="title-meta">
                <p id="content" style="background-color: white; color: black; padding: 1.5rem; border-radius: 8px; border: 1px solid #ddd; line-height: 1.8;">
                    {{ $passage->content }}
                </p>
            </div>
            <input type="hidden" id="readingTime" name="readingTime" value="0">

            <button id="offbtn" class="off">
                <a>Done Reading?</a>
                <a href="{{ route('questions.show', $passage->id) }}" class="btn btn-primary" id="questionLink">
                    Go to Questions
                </a>
            </button>
        </div>

<script>

const trun = document.querySelector(".turn");
const off = document.querySelector(".off");
const timer = document.getElementById("timer");
let content = document.getElementById("content");
let offbtn = document.getElementById("offbtn");
content.style.display = 'none';
offbtn.style.display = 'none';

let counter = 0;
let stopLoop;

// start counter
trun.onclick = () => {
    content.style.display = 'block';
    offbtn.style.display = 'flex';
    counter = 0;
    timer.textContent = '0s';
    stopLoop = setInterval(() => {
        counter++;
        const minutes = Math.floor(counter / 60);
        const seconds = counter % 60;
        if (minutes > 0) {
            timer.textContent = minutes + 'm ' + seconds + 's';
        } else {
            timer.textContent = counter + 's';
        }
    }, 1000);
};

// stop counter and update link
off.onclick = () => {
    offbtn.style.display = 'none';

    if (stopLoop) {
        clearInterval(stopLoop);
    }
    const link = document.getElementById("questionLink");
    link.href = link.href.split('?')[0] + "?Duration=" + counter;
};

</script>

@endsection