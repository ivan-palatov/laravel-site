@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('notification') }}
    </div>
    @endif
    
    <h1 class="text-center">Replies for comment</h1>
    <div class="media">
        <a href="#" class="pull-left">
            <img
                height="64"
                src="/images/{{ $replies[0]->comment->photo }}"
                alt="{{$replies[0]->comment->author}}'s Photo"
                class="media-object">
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                {{ $replies[0]->comment->author }}
                <small>{{ $replies[0]->comment->created_at->diffForHumans() }}</small>
            </h4>
            <p>{{ $replies[0]->comment->body }}</p>
        </div>
    </div>
    <hr>

    @if (count($replies))
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Reply</th>
                    <th>Post</th>
                    <th>Created</th>
                    <th>Controlls</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($replies as $reply)
                    <tr>
                        <td>{{ $reply->id }}</td>
                        <td>{{ $reply->author }}</td>
                        <td>{{ $reply->email }}</td>
                        <td>{{ str_limit($reply->body, 15) }}</td>
                        <td>
                            <a href="{{ route('home.post', $reply->comment->post_id) }}">View Post</a>
                        </td>
                        <td>{{ $reply->created_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="{{ $reply->is_active == 0 ? 1 : 0 }}">
                            <div class="form-group">
                                {!! Form::submit($reply->is_active ? 'Deactivate' : 'Activate', 
                                    ['class'=>$reply->is_active ? 'btn btn-info' : 'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center lead">There are no replies for this comment</p>
    @endif
    
@endsection