<?php

namespace App\Models;


use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    protected $fillable = [
        'question',
        'answer',
        'category_id',
        'order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class);
}


}
