@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notification</div>

                    <div class="card-body">
                        @foreach($user->notifications as $notification)
                            @include('notifications.'.snake_case(class_basename($notification->type)))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
