@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('notification') }}
    </div>
    @endif
    
    <h1 class="text-center">All Comments</h1>
    @if (count($comments))
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Post</th>
                    <th>Created</th>
                    <th>Controlls</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ str_limit($comment->body, 15) }}</td>
                        <td>
                            <a href="{{ route('home.post', $comment->post->id) }}">View Post</a>
                        </td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="{{ $comment->is_active == 0 ? 1 : 0 }}">
                            <div class="form-group">
                                {!! Form::submit($comment->is_active ? 'Deactivate' : 'Activate', 
                                    ['class'=>$comment->is_active ? 'btn btn-info' : 'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
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
        <p class="text-center lead">There are no comments</p>
    @endif
    
@endsection