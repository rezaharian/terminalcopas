@extends('layouts.appmaster')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Edit User</h2>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.users.form', ['user' => $user])
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
