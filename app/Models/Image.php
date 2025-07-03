<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'url', 'type', 'position'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}