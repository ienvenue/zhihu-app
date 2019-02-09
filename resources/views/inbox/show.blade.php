@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <form action="/inbox/{{$dialogId}}/store" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-success">Send</button>
                            </div>
                        </form>
                        <div class="messages-list">
                            @foreach($messages as $message)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img width="50" src="{{ $message->fromUser->avatar }}" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="#">
                                                {{ $message->fromUser->name }}
                                            </a>
                                        </h4>
                                        <p>
                                            {{ $message->body }} <span
                                                    class="float-right">{{ $message->created_at->format('Y-m-d H:i:s') }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
