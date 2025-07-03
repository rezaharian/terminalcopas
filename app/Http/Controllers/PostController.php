<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Technology;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/**
 * @method \Illuminate\Routing\Controller middleware(array|string $middleware, array $options = [])
 */
class PostController extends Controller
{


    public function index()
    {
        $posts = Post::latest()->with('category', 'tags', 'technologies')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category', 'tags', 'technologies', 'images']);
        return view('posts.show', compact('post'));
    }


    public function create()
    {
        return view('posts.create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'technologies' => Technology::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'content' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array|nullable',
            'technologies' => 'array|nullable',
            'cover' => 'nullable|image|max:2048',
            'internal_images.*' => 'nullable|image|max:2048',
            'status' => 'in:draft,published',
            'url_download' => 'nullable|url|max:255', // ✅ ditambahkan
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'author_id' => Auth::id(),
            'category_id' => $validated['category_id'] ?? null,
            'status' => $validated['status'] ?? 'draft',
            'url_download' => $validated['url_download'] ?? null, // ✅ ditambahkan
        ]);

        // Tag & Tech
        $post->tags()->sync($validated['tags'] ?? []);
        $post->technologies()->sync($validated['technologies'] ?? []);

        // Cover
        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('posts', 'public');
            Image::create([
                'post_id' => $post->id,
                'url' => '/storage/' . $path,
                'type' => 'cover',
                'position' => 1
            ]);
        }

        // Internal images
        if ($request->hasFile('internal_images')) {
            $i = 1;
            foreach ($request->file('internal_images') as $img) {
                $path = $img->store('posts', 'public');
                Image::create([
                    'post_id' => $post->id,
                    'url' => '/storage/' . $path,
                    'type' => 'internal',
                    'position' => $i++
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }


    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'technologies' => Technology::all()
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'content' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array|nullable',
            'technologies' => 'array|nullable',
            'status' => 'in:draft,published',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'internal_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'url_download' => 'nullable|url|max:255', // ✅ ditambahkan
        ]);

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'status' => $validated['status'] ?? 'draft',
            'url_download' => $validated['url_download'] ?? null, // ✅ ditambahkan
        ]);

        // Tag & Tech
        $post->tags()->sync($validated['tags'] ?? []);
        $post->technologies()->sync($validated['technologies'] ?? []);

        // Cover
        if ($request->hasFile('cover')) {
            $oldCover = $post->images()->where('type', 'cover')->first();
            if ($oldCover) {
                // Optional: Storage::delete($oldCover->url);
                $oldCover->delete();
            }

            $coverPath = $request->file('cover')->store('images', 'public');
            $post->images()->create([
                'url' => '/storage/' . $coverPath,
                'type' => 'cover',
                'position' => 1,
            ]);
        }

        // Internal Images
        if ($request->hasFile('internal_images')) {
            $post->images()->where('type', 'internal')->delete();

            foreach ($request->file('internal_images') as $index => $image) {
                $path = $image->store('images', 'public');
                $post->images()->create([
                    'url' => '/storage/' . $path,
                    'type' => 'internal',
                    'position' => $index + 1,
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $post->images()->delete();
        $post->tags()->detach();
        $post->technologies()->detach();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }
}
