@extends('layouts.app')

@section('content')
    @if(session()->has('sukses'))
    <div class="alert alert-success" role="alert">
        {{ session('sukses') }}
    </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="{{ route('category.create') }}" class="btn btn-success"><i class="fas fa-plus-square"></i> Add Category</a>
                <div class="card-body">
                    <h5 class="card-title text-center">Category List</h5>
                    <div class="table-responsive">
                        <table class="table">
                            @php
                                $no = 1
                            @endphp
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure?');"
                                            action="{{ route('category.destroy', $category) }}" method="POST">
                                            <a href="{{ route('category.show', $category) }}" class="btn"><i class="fas fa-eye"  style="color: rgb(0, 0, 0)"></i></a>
                                            <a href="{{ route('category.edit', $category) }}" class="btn"><i class="fas fa-edit"  style="color: blue"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn"><i class="fas fa-trash"  style="color: red"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
