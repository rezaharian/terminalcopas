@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h2>Tambah Post</h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('posts._form', ['submit' => 'Simpan'])
        </form>
    </div>
@endsection
