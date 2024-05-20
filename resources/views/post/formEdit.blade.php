@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Edit Post</h4>
                    <form action="{{ route('post.update', $posting) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" name="title" value="{{ old('title', $posting->title) }}" placeholder="E.g. Food & Culiner" type="text" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-md-4 col-form-label">Slug</label>
                            <div class="col-md-6">
                                <input id="slug" name="slug" value="{{ old('slug', $posting->slug) }}" placeholder="E.g. food-and-culiner" type="text" class="form-control @error('slug') is-invalid @enderror">
                                @error('slug')
                                    <div class="alert alert-danger">
                                        <strong>Error!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label">Category</label>
                            <div class="col-md-6">
                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                    <option selected>Choose...</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $posting->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger mt-2">
                                        <strong>Error!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label">Body</label>
                            <div class="col-md-6">
                                <input id="body" value="{{ old('body', $posting->body) }}" type="hidden" name="body">
                                <trix-editor input="body"></trix-editor>
                                @error('body')
                                    <div class="alert alert-danger mt-2">
                                        <strong>Error!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
