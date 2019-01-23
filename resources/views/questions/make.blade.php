@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Post issue</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action={{route('questions.index')}} method="post">
                            {!! csrf_field() !!}
                            <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                                <label for="title">Title</label>
                                <input type="text" value="{{old('title')}}" name="title" class="form-control"
                                       placeholder="Title" id="title">
                                @if ($errors->has('title'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('title') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" {{ $errors->has('body') ? ' has-error' : '' }}>
                                <label for="title">Description</label>
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" style="height:300px" type="text/plain">
                                    {!!  old('body') !!}
                                </script>
                                @if ($errors->has('body'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('body') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success float-right" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
