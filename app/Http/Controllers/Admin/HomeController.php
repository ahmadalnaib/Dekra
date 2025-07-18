<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class HomeController extends Controller
{
    //
     public function index()
    {
        $categories = Category::all();
        return Inertia::render('Welcome', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
}
