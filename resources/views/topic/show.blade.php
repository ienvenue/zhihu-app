@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show {{$topic->name}} Questions</div>

                    <div class="card-body">
                        @foreach($question as $question)
                            <div class="media">
                                <div class="media-left">
                                    <a href="">
                                        <img width="50" src="{{$question->user->avatar}}" alt="{{$question->user->name}}">
                                    </a>
                                </div>
                                <div class="media-body" style="margin-top: 15px;">
                                    <h4 class="media-heading">
                                        <a href="{{route('questions.show',$question->id)}}">
                                            {{$question->title}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
