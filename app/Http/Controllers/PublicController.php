<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    //

    public function index()
    {
        $categories = [
            'posts_sc' => 1,          // Source Code
            'posts_tutor' => 2,       // Tutorial
            'posts_artikel' => 3,     // Artikel
            'posts_tipstriks' => 4,   // Tips & Trik
            'posts_berita' => 5       // Berita
        ];

        $posts = [];

        foreach ($categories as $key => $categoryId) {
            $posts[$key] = Post::latest()
                ->with(['category', 'tags', 'technologies', 'images', 'author'])
                ->where('status', 'published')
                ->where('category_id', $categoryId)
                ->paginate(4);
        }

        return view('public.home', $posts);
    }


    public function post_show($id, $slug)
    {

        $post = Post::with([
            'category',
            'author',
            'tags',
            'technologies',
            'images',
            'comments' => function ($query) {
                $query->latest(); // ⬅️ Komentar utama terbaru di atas
            },
            'comments.replies' => function ($query) {
                $query->oldest(); // ⬅️ (opsional) reply tetap urutan lama dulu
            },
        ])->findOrFail($id);


        // Optional: Cek jika slug tidak cocok, redirect ke URL benar
        if (Str::slug($post->title) !== $slug) {
            return redirect()->route('posts.show', ['id' => $post->id, 'slug' => Str::slug($post->title)]);
        }

        return view('public.posts.show', compact('post'));
    }

    public function kategori($slug)
    {
        // dd('hh');
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::latest()
            ->with(['category', 'tags', 'technologies', 'images', 'author'])
            ->where('status', 'published')
            ->where('category_id', $category->id)
            ->paginate(12);
        return view('public.posts.kategori', compact('category', 'posts'));
    }

    public function teknologi($slug)
    {
        // Ambil data teknologi berdasarkan slug
        $tech = Technology::all()->first(function ($t) use ($slug) {
            return Str::slug($t->name) === $slug;
        });

        if (!$tech) {
            abort(404);
        }

        // Daftar kategori dan id
        $categories = [
            'posts_sc' => 1,          // Source Code
            'posts_tutor' => 2,       // Tutorial
            'posts_artikel' => 3,     // Artikel
            'posts_tipstriks' => 4,   // Tips & Trik
            'posts_berita' => 5       // Berita
        ];

        $posts = [];

        foreach ($categories as $key => $categoryId) {
            $posts[$key] = \App\Models\Post::latest()
                ->with(['category', 'tags', 'technologies', 'images', 'author'])
                ->where('status', 'published')
                ->where('category_id', $categoryId)
                ->whereHas('technologies', function ($q) use ($tech) {
                    $q->where('technology_id', $tech->id);
                })
                ->get();
        }

        return view('public.posts.teknologi', compact('tech', 'posts'));
    }
}
