@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Message</div>

                    <div class="card-body">
                        @foreach($messages as $messageGroup)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="50" src="{{ $messageGroup->first()->fromUser->avatar }}" alt="">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="#">
                                            {{ $messageGroup->first()->fromUser->name }}
                                        </a>
                                    </h4>
                                    <p>
                                        <a href="/inbox/{{ $messageGroup->first()->fromUser->id }}">
                                            {{ $messageGroup->first()->body }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
