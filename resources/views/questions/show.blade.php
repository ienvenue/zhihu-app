@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $question->title }}
                        @foreach($question->topics as $topic)
                            <a class="topic" href="/topic/{{$topic->id}}">{{$topic->name}}</a>
                        @endforeach
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! $question->body !!}
                    </div>
                    <div class="actions">
                        @if(Auth::check()&& Auth::user()->owns($question))
                            <span class="edit"><a href="{{route('questions.edit',$question->id)}}">Edit</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
