@extends('layouts.appmaster')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Detail User</h2>

        <ul class="list-group">
            <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Role:</strong> {{ $user->getRoleNames()->implode(', ') }}</li>
        </ul>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
