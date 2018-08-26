@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('notification') }}
        </div>
    @endif

    <h1>Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if($posts)
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <img 
                                src="/images/{{ $post->photo ? $post->photo->file : 'default-image.png' }}" 
                                alt="Post Image"
                                height="40">
                        </td>
                        <td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category_id ? $post->category->name : 'None' }}</td>
                        <td>{{ str_limit($post->body, 20) }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection