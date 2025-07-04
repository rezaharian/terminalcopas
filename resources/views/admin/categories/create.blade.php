@csrf @extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h2>Add Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
