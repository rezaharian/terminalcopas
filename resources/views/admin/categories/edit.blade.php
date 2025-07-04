@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h2>Edit Category</h2>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
