<div class="mb-3">
    <label>Judul</label>
    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control">{{ old('description', $post->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Konten</label>
    <textarea name="content" class="form-control" rows="6">{{ old('content', $post->content ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>URL Download (opsional)</label>
    <input type="url" name="url_download" value="{{ old('url_download', $post->url_download ?? '') }}"
        class="form-control" placeholder="https://contoh.com/file.zip">
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-select">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
        <option value="draft" {{ old('status', $post->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ old('status', $post->status ?? '') == 'published' ? 'selected' : '' }}>Published
        </option>
    </select>
</div>

<div class="mb-3">
    <label>Tag</label>
    <select name="tags[]" class="form-select" multiple>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" @if (isset($post) && $post->tags->pluck('id')->contains($tag->id)) selected @endif>{{ $tag->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Teknologi</label>
    <select name="technologies[]" class="form-select" multiple>
        @foreach ($technologies as $tech)
            <option value="{{ $tech->id }}" @if (isset($post) && $post->technologies->pluck('id')->contains($tech->id)) selected @endif>{{ $tech->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Gambar Cover</label>
    <input type="file" name="cover" class="form-control">
</div>

<div class="mb-3">
    <label>Gambar Internal (bisa lebih dari satu)</label>
    <input type="file" name="internal_images[]" multiple class="form-control">
</div>

<button class="btn btn-primary">{{ $submit }}</button>
<a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
