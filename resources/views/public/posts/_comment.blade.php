<div class="mb-3 p-3 rounded border bg-white small">
    <div class="fw-semibold">{{ $comment->user->name ?? 'Anonim' }}
        <span class="text-muted">• {{ $comment->created_at->diffForHumans() }}</span>
    </div>
    <div class="text-secondary mb-2">{{ $comment->content }}</div>
    <div class="replies ms-3 ps-3 border-start"></div>

    @auth
        <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="reply-form mt-2 small">
            @csrf
            <textarea name="content" rows="2" class="form-control form-control-sm mb-2" placeholder="Balas komentar..."></textarea>
            <button class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-reply me-1"></i> Balas
            </button>
        </form>
    @endauth
</div>
