@extends('layouts.admin')

@section('content')
    <h1>Create Category</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Category name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('admin.error')


@endsection