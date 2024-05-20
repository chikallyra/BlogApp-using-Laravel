@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Edit Category</h4>
                    <form action="{{ route('category.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Gunakan method PUT untuk proses update -->

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Category Name</label>
                            <div class="col-md-6">
                                <input id="name" name="name" placeholder="E.g. Food & Culiner" value="{{ old('name', $category->name) }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $message }}.
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-md-4 col-form-label text-md-right">Slug</label>
                            <div class="col-md-6">
                                <input id="slug" name="slug" placeholder="E.g. food-and-culiner" value="{{ old('slug', $category->slug) }}" type="text" class="form-control @error('slug') is-invalid @enderror">
                                @error('slug')
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $message }}.
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
