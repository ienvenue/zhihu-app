@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'}
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="card">
                    <div class="card-header">{{ $question->title }}
                        @foreach($question->topics as $topic)
                            <a class="topic" href="/topic/{{$topic->id}}">{{$topic->name}}</a>
                        @endforeach
                    </div>
                    <div class="card-body content">
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
                            <form action="{{route('questions.destroy',$question->id)}}" method="post"
                                  class="delete-form">
                                {{method_field('DELETE')}}
                                {!! csrf_field() !!}
                                <button class="button is-naked delete-button">Del</button>
                            </form>
                        @endif
                        <comments type="question"
                                  model="{{$question->id}}"
                                  count="{{$question->comments()->count()}}">
                        </comments>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="text-align: center">
                    <div class="card-header">
                        <h2>{{ $question->followers_count}}</h2>
                        <span>Followers</span>
                    </div>
                    {{--@if(Auth::check())--}}
                    <div class="card-body ">
                        <question-follow-button question="{{$question->id}}"></question-follow-button>
                        {{--<a href="/questions/{{$question->id}}/follow"--}}
                        {{--class="btn btn-primary {{ Auth::user()->followed($question->id) ? 'btn-success' : ''}}">--}}
                        {{--{{Auth::user()->followed($question->id) ? 'Followed' : 'Follow'}}--}}
                        {{--</a>--}}
                        <a href="#label" class="btn btn-primary">Answer</a>

                        {{--@else--}}
                        {{--<a href="{{route('login')}}" class="btn btn-success btn-block">Login to follow</a>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <br/>
                <div class="card">
                    <div class="card-header">
                        Have {{ $question->answers_count }} Answer
                    </div>
                    <div class="card-body">
                        @foreach($question->answer as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <user-vote-button answer="{{$answer->id}}"
                                                      count="{{$answer->votes_count}}"></user-vote-button>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{$answer->user->name}}">
                                            {{$answer->user->name}}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                                <comments type="answer"
                                          model="{{$answer->id}}"
                                          count="{{$answer->comments()->count()}}">
                                </comments>
                            </div>
                        @endforeach
                        @if(Auth::check())
                            <form action="/questions/{{$question->id}}/answer" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <a name="label">
                                        <script id="container" name="body" style="height:200px" type="text/plain">
                                        {!!  old('body') !!}
                                        </script>
                                    </a>
                                    @if ($errors->has('body'))
                                        <span class="help-block" style="color:red">
                                            <strong>{{ $errors->first('body') }} </strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="btn btn-success float-right" type="submit">Submit</button>
                            </form>
                        @else
                            <a href="{{url('login')}}" class="btn btn-success btn-block">
                                Login to submit answer
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                </br>
                <div class="card">
                    <div class="card-header question-follow">
                        <h5>About author</h5>
                    </div>
                    <div class="card-body">
                        <div class="media ">
                            <div class="media-left">
                                <a href="#">
                                    <img width="30" src="{{$question->user->avatar}}"
                                         alt="{{$question->user->name}}">
                                </a>
                            </div>
                            <div class="media-body ">
                                <h4 class="media-heading"><a href="">
                                        {{ $question->user->name }}
                                    </a>
                                </h4>
                                <div class="user-statics">
                                    <div class="statics-item text-center">
                                        <div class="statics-text">Q</div>
                                        <div class="statics-count">{{ $question->user->question_count }}</div>
                                    </div>
                                    <div class="statics-item text-center">
                                        <div class="statics-text">A</div>
                                        <div class="statics-count">{{ $question->user->answer_count }}</div>
                                    </div>
                                    <div class="statics-item text-center">
                                        <div class="statics-text">F</div>
                                        <div class="statics-count">{{ $question->user->followers_count }}</div>
                                    </div>
                                </div>
                                <div>
                                    <user-follow-button user="{{$question->user_id}}"></user-follow-button>
                                    @if(Auth::check() && user()->id != $question->user_id)
                                        <send-message user="{ $question->user_id }"></send-message>
                                    @elseif(Auth::check() && user()->id == $question->user_id )
                                    @else
                                        <a href="{url('user/login')}" class="btn btn-default">Message</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection