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
    <p>{!! $post->body !!}</p>
    <hr>

    {{-- Comments Section --}}
    @if(Auth::check())
        {{-- Show notifications --}}
        @if (Session::has('notification'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('notification') }}
            </div>
        @endif

        {{-- Comment form --}}
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
    {{-- Show comments --}}
    @if (count($comments))
        @foreach ($comments as $comment)
            <div class="media">
                <a href="#" class="pull-left">
                    <img 
                        height="64" 
                        src="/images/{{ $comment->photo }}" 
                        alt="{{$comment->author}}'s Photo" 
                        class="media-object">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{ $comment->author }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    <p>{{ $comment->body }}</p>
                    <hr>
                    {{-- Comment replies --}}
                    @if (count($comment->replies))
                    @foreach ($comment->replies as $reply)
                        <div class="media">
                            <a href="#" class="pull-left">
                                <img 
                                    height="64" 
                                    src="/images/{{ $reply->photo }}" 
                                    alt="{{ $reply->author }}'s Photo" 
                                    class="media-object">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    {{ $reply->author }}
                                    <small>{{ $reply->created_at->diffForHumans() }}</small>
                                </h4>
                                <p>{{ $reply->body }}</p>
                            </div>
                        </div>
                        <br>
                    @endforeach
                    @endif

                    {{-- Reply form --}}
                    <div class="well">
                        <h4>Reply:</h4>
                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Reply', ['class'=>'btn btn-primary pull-right']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
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