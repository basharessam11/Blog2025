<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $guarded = [];

    public function getMeta($page, $locale)
{
    return [
        'title' => $this->{$page . '_title_' . $locale} ?? $this->index_title_ar,
        'description' => $this->{$page . '_description_' . $locale} ?? $this->index_description_ar,
    ];
}

}
