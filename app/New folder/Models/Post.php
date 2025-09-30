<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'source_url',
        'article_type_id',
    ];

    public function articleType()
    {
        return $this->belongsTo(ArticleType::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
