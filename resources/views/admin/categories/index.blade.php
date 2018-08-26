@extends('layouts.admin')

@section('content')
    @if (Session::has('notification'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('notification') }}
    </div>
    @endif

    <h1>Categories</h1>

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
@endsection