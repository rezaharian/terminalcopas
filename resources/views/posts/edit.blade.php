@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h2>Edit Post</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('posts._form', ['submit' => 'Update'])
        </form>
    </div>
@endsection
