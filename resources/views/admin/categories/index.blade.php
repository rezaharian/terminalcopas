@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h2>Category List</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection
