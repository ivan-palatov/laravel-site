@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>
        {{-- Delete category button --}}
        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

        {{-- Edit category form --}}
        {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id], 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
        

        @include('admin.error')

    </div>


@endsection