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
                        <form action="{{route('questions.update',$question->id)}}" method="post">
                            {{method_field('PATCH')}}
                            {!! csrf_field() !!}
                            <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                                <label for="title">Title</label>
                                <input type="text" value="{{$question->title}}" name="title" class="form-control"
                                       placeholder="Title" id="title">
                                @if ($errors->has('title'))
                                    <span class="help-block" style="color:red">
                                        <strong>{{ $errors->first('title') }} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">

                                <label for="topic">Topic</label>
                                <select name="topics[]" class="js-example-placeholder-multiple  js-states form-control" multiple="multiple">
                                @foreach($question->topics as $topic)
                                        <option value="{{$topic->id}}" selected="selected">{{$topic->name}}</option>

                                @endforeach
                                </select>
                            </div>
                            <div class="form-group" {{ $errors->has('body') ? ' has-error' : '' }}>
                                <label for="title">Description</label>
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" style="height:300px" type="text/plain">
                                    {!!  $question->body!!}
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
                                        {{--@endsection--}}
                                        {{--@section('js')--}}
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
                                $(document).ready(function () {

                                    function formatTopic (topic) {

                                        return "<div class='select2-result-repository clearfix'>" +

                                        "<div class='select2-result-repository__meta'>" +

                                        "<div class='select2-result-repository__title'>" +

                                        topic.name ? topic.name : "Laravel"   +

                                            "</div></div></div>";

                                    }


                                    function formatTopicSelection (topic) {

                                        return topic.name || topic.text;

                                    }


                                    $(".js-example-placeholder-multiple").select2({

                                        tags: true,

                                        placeholder: 'choose topic',

                                        minimumInputLength: 2,


                                        ajax: {

                                            url: '/api/topics',

                                            dataType: 'json',

                                            delay: 250,

                                            data: function (params) {

                                                return {

                                                    q: params.term

                                                };

                                            },

                                            processResults: function (data, params) {

                                                return {

                                                    results: data

                                                };

                                            },

                                            cache: true

                                        },

                                        templateResult: formatTopic,

                                        templateSelection: formatTopicSelection,

                                        escapeMarkup: function (markup) { return markup; }

                                    });
                                    ;
                                });


                                </script>
    {{--@endsection--}}


@endsection
