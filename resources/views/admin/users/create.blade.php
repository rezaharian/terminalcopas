@extends('layouts.appmaster')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Tambah User</h2>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            @include('admin.users.form', ['user' => null])
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
