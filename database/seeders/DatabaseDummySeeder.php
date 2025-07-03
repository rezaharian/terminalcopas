<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Technology;
use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseDummySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat user (admin + user biasa)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'reza@gmail.com',
            'password' => Hash::make('11111111'),
        ]);

        User::factory(9)->create(); // total 10 user

        $users = User::all();

        // 2. Buat kategori
        $categoryNames = ['Sourcecode', 'Tutorial', 'Artikel', 'Tips & Tricks', 'Berita'];
        foreach ($categoryNames as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
        $categories = Category::all();

        // 3. Buat teknologi
        $techNames = ['Laravel', 'CodeIgniter', 'PHP', 'Vue.js', 'React', 'HTML', 'CSS', 'JavaScript'];
        foreach ($techNames as $name) {
            Technology::create(['name' => $name]);
        }
        $technologies = Technology::all();

        // 4. Buat tag
        $tagNames = ['tokopedia-clone', 'crud', 'admin-panel', 'login-register', 'API', 'ajax', 'ui-kit', 'ecommerce', 'blog', 'dashboard'];
        foreach ($tagNames as $tag) {
            Tag::create(['name' => $tag]);
        }
        $tags = Tag::all();

        // 5. Buat post
        for ($i = 1; $i <= 50; $i++) {
            $title = "Contoh Judul Post ke-$i";
            $url = "https://example.com/downloads/post-$i.zip"; // atau random URL

            $post = Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => "Ini adalah deskripsi dari $title",
                'content' => "<p>Konten lengkap dari $title. Disini bisa panjang...</p>",
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'status' => rand(0, 1) ? 'published' : 'draft',
                'url_download' => $url,
            ]);

            // Gambar
            $coverRand = rand(1000, 9999);
            Image::create([
                'post_id' => $post->id,
                'url' => "https://picsum.photos/600/300?random=$coverRand",
                'type' => 'cover',
                'position' => 1,
            ]);

            $internalCount = rand(2, 4);
            for ($j = 1; $j <= $internalCount; $j++) {
                $randomValue = rand(10000, 99999); // beda dari coverRand
                Image::create([
                    'post_id' => $post->id,
                    'url' => "https://picsum.photos/600/300?random=$randomValue",
                    'type' => 'internal',
                    'position' => $j,
                ]);
            }

            // Tags & Technologies
            $post->tags()->attach($tags->random(rand(2, 4))->pluck('id')->toArray());
            $post->technologies()->attach($technologies->random(rand(1, 3))->pluck('id')->toArray());

            // Komentar & balasan
            $commentCount = rand(2, 5);
            for ($k = 1; $k <= $commentCount; $k++) {
                $comment = Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'content' => "Komentar ke-$k di post $i",
                ]);

                $replyCount = rand(1, 3);
                for ($r = 1; $r <= $replyCount; $r++) {
                    CommentReply::create([
                        'comment_id' => $comment->id,
                        'user_id' => $users->random()->id,
                        'content' => "Balasan ke-$r untuk komentar ke-$k di post $i",
                    ]);
                }
            }
        }

        $this->command->info('✅ Semua dummy data berhasil dibuat.');
    }
}