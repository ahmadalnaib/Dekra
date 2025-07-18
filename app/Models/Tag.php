<?php

namespace App\Models;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function faqs()
{
    return $this->belongsToMany(Faq::class);
}
}
