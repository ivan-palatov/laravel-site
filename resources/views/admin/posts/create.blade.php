@extends('layouts.admin')

@section('content')
    @include('admin.posts.editor')
    <h1>Create Post</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('body', 'Post:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('image', 'Image:') !!}
            {!! Form::file('image', null, ['class'=>'form-control']) !!}
        </div>
        

        <div class="form-group">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    @include('admin.error')
    
@endsection