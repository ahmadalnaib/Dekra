<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class HomeController extends Controller
{
    //
     public function index()
    {
        $categories = Category::all();
        $faqs = Faq::with('category')
                   ->latest()
                   ->get();
                   
        return Inertia::render('Welcome', [
            'categories' => CategoryResource::collection($categories),
            'faqs' => FaqResource::collection($faqs),
        ]);
    }
}
