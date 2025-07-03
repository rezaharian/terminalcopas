<div class="mb-2">
    <strong>{{ $reply->user->name ?? 'Anonim' }}</strong>:
    {{ $reply->content }}
    <div class="text-muted small">{{ $reply->created_at->diffForHumans() }}</div>
</div>
