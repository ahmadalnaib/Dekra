<?php

namespace App\Models;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
