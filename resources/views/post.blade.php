@extends('layouts.blog-post')

@section('content')
    <!-- Blog Post -->
    <!-- Title -->
    <h1>{{ $post->title }}</h1>
    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>
    <hr>
    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>
    <hr>
    <!-- Preview Image -->
    <img class="img-responsive" 
        src="/images/{{ $post->photo_id ? $post->photo->file : 'default-image.png' }}" 
        alt="Post Image">
    <hr>
    <!-- Post Content -->
    <p>{{ $post->body }}</p>
    <hr>

    {{-- Comments Section --}}
    @if(Auth::check())
        @if (Session::has('notification'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('notification') }}
            </div>
        @endif

        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Add Comment', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    @endif

@endsection

@section('categories')
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
    </div>
@endsection