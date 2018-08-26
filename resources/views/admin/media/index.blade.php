@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('notification') }}
    </div>
    @endif

    <h1>Media</h1>
    @if ($photos)
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($photos)
                    @foreach ($photos as $photo)
                        <tr>
                            <td>{{ $photo->id }}</td>
                            <td><img height="60" src="/images/{{ $photo->file }}" alt="Image {{ $photo->id }}"></td>
                            <td>{{ $photo->created_at->diffForHumans() }}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endif
@endsection