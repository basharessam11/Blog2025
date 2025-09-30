<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        // عند حفظ المنتج (إضافة أو تعديل)
        static::saving(function ($blog) {
             if (!$blog->slug) {
                $blog->slug_ar = str_replace(' ', '-', $blog->title_ar) . '-' . $blog->id;
                $blog->slug_en = Str::slug($blog->title_en . '-' . $blog->id);
            } else {
                $blog->slug_ar = str_replace(' ', '-', $blog->title_ar) . '-' . $blog->id;


                $blog->slug_en = Str::slug($blog->title_en . '-' . $blog->id);
            }
        });
    }



    public function setImageAttribute($value)
    {


        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        $value[1] => $file->store('blog', 'blog'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes[$value[1]] = $value->store('blog', 'blog');
        } else {
            $this->attributes[$value[1]] = $value;
        }
    }

    public function blogComment()  {
        return $this->hasMany(BlogComment::class);

    }

    public function blogDescription()  {
        return $this->hasMany(BlogDescription::class,'blog_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class );
    }
}
