<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\Tag;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $faqs = Faq::with('category')->latest()->paginate(1);

        // return Inertia::render('faqs/Index', [
        //     'faqs' => FaqResource::collection($faqs),
        // ]);
        $faqs = Faq::with('category')->latest()->paginate(15);
        $categories = Category::all(); // Make sure this line is present
        $tags = Tag::all(); // Make sure this li
        return Inertia::render('faqs/Index', [
            'faqs' => $faqs,
            'categories' => $categories, // Make sure categories are passed
            'tags' => $tags, // Make sure tags are passed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('faqs/Create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $faq = Faq::create([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category_id' => $validated['category_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Attach tags if provided
        if (!empty($validated['tags'])) {
            $faq->tags()->attach($validated['tags']);
        }

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::with(['category', 'tags'])->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('faqs/Edit', [
            'faq' => new FaqResource($faq),
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category_id' => $validated['category_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Sync tags (this will remove old tags and add new ones)
        if (isset($validated['tags'])) {
            $faq->tags()->sync($validated['tags']);
        } else {
            $faq->tags()->detach();
        }

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->tags()->detach(); // Remove tag relationships
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ erfolgreich gelöscht.');
    }
}
