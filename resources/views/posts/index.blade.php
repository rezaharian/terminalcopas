@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4 class="fw-semibold mb-0">Daftar Post</h4>
            <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Post
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle mb-0 small">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th style="width: 30%">Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Penulis</th>
                                <th style="width: 23%">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php use Illuminate\Support\Str; @endphp

                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ Str::limit($post->title, 28) }}</td>
                                    <td>{{ $post->category->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $post->author->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-light"
                                                title="Lihat">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-light"
                                                title="Edit">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus post ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light" title="Hapus">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada post.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 small">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
