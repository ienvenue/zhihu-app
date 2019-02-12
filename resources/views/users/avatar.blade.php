@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ChangeAvatar</div>

                    <div class="card-body">
                        <user-avatar avatar="{{ Auth::user()->avatar }}"></user-avatar>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
