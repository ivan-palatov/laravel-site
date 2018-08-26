@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('notification') }}
    </div>
    @endif

    <h1 class="text-center">Categories</h1>

    <div class="col-md-6">
        <h3 class="text-center">Create Category</h3>

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
        <div class="form-group">
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>
    
        {!! Form::close() !!}
    
        @include('admin.error')
    </div>

    <div class="col-md-6">
        <h3 class="text-center">Categories List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @if($categories)
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection