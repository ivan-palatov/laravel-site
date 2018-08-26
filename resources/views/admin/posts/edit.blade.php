@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>

    <div class="col-sm-3">
        <img 
            src="/images/{{ $post->photo ? $post->photo->file : 'default-image.png' }}" 
            alt="Post Image" 
            class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {{-- Delete post button --}}
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

        {{-- Edit post form --}}
        {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
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
                {!! Form::submit('Edit Post', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}

        @include('admin.error')
    </div>
    
@endsection