@extends('layouts.home')
@section('sidebar')
<br><br><br><br>
<h1 class="my-4">{{$TheCourse->title}}</h1>
<div class="list-group">
    @foreach ($publishedLessons as $pub)
    <a href="{{route('lessons.show',[$pub->course->first()->id, $pub->slug])}}" class="list-group-item"
        @if ($pub->id==$lesson->id)
         style="font-weight:bold; color:red"
        @endif
        >{{$loop->iteration}}.{{$pub->title}}</a>
    @endforeach


@endsection
@section ('main1')
 <h2>{{ $lesson->title }}</h2>

 @if ($purchased_course || $lesson->free_lesson == 1)
     {{-- @if (session('message'))
    <div class="alert alert-info">{{session('message')}}</div>

     @endif --}}
    <p>{{ $lesson->full_text }}</p>
    @if ($test_exists)
            <hr />
            <h3>Test: {{ $lesson->test->first()->title }}</h3>
            @if (!is_null($test_result))
                <div class="alert alert-info">Your test score: {{ $test_result->test_result }}</div>
            @else
            <form action="{{ route('lessons.test', [$lesson->slug]) }}" method="post">
                {{ csrf_field() }}
                @foreach ($lesson->test->first()->questions as $question)
                    <b>{{ $loop->iteration }}. {{ $question->question }}</b>
                    <br />
                    @foreach ($question->options as $option)
                        <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option->id }}" /> {{ $option->option_text }}<br />
                    @endforeach
                    <br />
                @endforeach
                <input type="submit" value=" Submit results " />
            </form>
             @endif
            <hr />
        @endif
 @else
    Please <a href="{{ route('courses.show', [$TheCourse->slug]) }}">go back</a> and buy the course.
 @endif

 @if ($previous_lesson)
    <a href="{{route('lessons.show',[$previous_lesson->course->first()->id, $previous_lesson->slug])}}"><< {{$previous_lesson->title}}</a>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
 @endif
 @if ($next_lesson)
    <a href="{{route('lessons.show',[$next_lesson->course->first()->id, $next_lesson->slug])}}"> {{$next_lesson->title}} >></a>

 @endif

@endsection
