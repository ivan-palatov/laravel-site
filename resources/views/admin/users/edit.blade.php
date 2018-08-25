@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>

    <div class="col-sm-3">
        <img src="/images/{{ $user->photo ? $user->photo->file : 'default.png' }}" alt="Photo" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-9">
        {{-- Delete user button --}}
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

        {{-- Edit user form --}}
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>

        
        
        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), $user->is_active, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('file', 'Photo:') !!}
            {!! Form::file('file', null, ['class'=>'form-control']) !!}
        </div>
        
        
        

        <div class="form-group">
            {!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
        

        @include('admin.error')

    </div>


@endsection