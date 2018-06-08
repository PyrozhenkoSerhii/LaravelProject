@extends('adminPage/adminPageMain')
@section('contentSecond')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h2 align="center">Editing</h2></div>
                <div align="center" class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('postSave') }}">
                        {{ csrf_field() }}

                        <textarea class="text-center" rows="0" cols="50" id="name" name="id" hidden>{{$post->id}}</textarea>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <b><p align="center" style="font-size:28px;">Title</p>
                                <textarea class="text-center" rows="2" style="width:80%;" id="name" name="title">{{$post->title}}</textarea>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <p align="center">Category</p>
                            <textarea class="text-center" rows="1" style="width:80%;" id="name" name="category">{{$post->category}}</textarea>
                            @if ($errors->has('category'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <p align="center" style="font-size:28px;">Description</p>
                            <textarea class="text-center" rows="3" style="width:80%;" id="name" name="description">{{$post->description}}</textarea>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <p align="center" style="font-size:28px;">Content</p>
                            <textarea class="text-center" rows="6" style="width:80%;" id="name" name="content">{{$post->content}}</textarea>

                            @if ($errors->has('content'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                            @endif
                        </div>
                        @if (!Auth::guest())
                            @foreach($adminsArray as $value)
                                @if($value == Auth::user()->id)
                                    <div class="form-group{{ $errors->has('lecsics') ? ' has-error' : '' }}">
                                        <p align="center">Lecsics</p>
                                        <textarea class="text-center" rows="6" style="width:80%;" id="name" name="lecsics">{{$post->lecsics}}</textarea>

                                        @if ($errors->has('lecsics'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lecsics') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('img_url') ? ' has-error' : '' }}">
                                        <p align="center">Links to the images</p>
                                        <textarea class="text-center" rows="1" style="width:80%;" id="name" name="img_url">{{$post->img_url}}</textarea>
                                        @if ($errors->has('img_url'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('img_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif



                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="published" {{ $post->published == 1 ? 'checked' : 'unchecked' }}> published
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
