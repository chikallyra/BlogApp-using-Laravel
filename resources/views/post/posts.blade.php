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
                <a href="{{ route('post.create') }}" class="btn btn-success"><i class="fas fa-plus-square"></i> Make a Post</a>
                <div class="card-body">     
                    <h5 class="card-title text-center">Posts</h5>    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Excerpt</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($posting as $posting)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $posting->title }}</td>
                                    <td>{{ $posting->excerpt }}</td>
                                    <td>{{ optional($posting->category)->name }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure?');"
                                            action="{{ route('post.destroy', $posting) }}" method="POST">
                                            <a href="{{ route('post.show', $posting) }}" class="btn"><i class="fas fa-eye"  style="color: rgb(0, 0, 0)"></i></a>
                                            <a href="{{ route('post.edit', $posting) }}" class="btn"><i class="fas fa-edit"  style="color: blue"></i></a>
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
