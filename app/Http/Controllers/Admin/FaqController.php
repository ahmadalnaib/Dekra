<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\Tag;
use Inertia\Inertia;
use App\Models\Category;
use App\Http\Requests\FaqRequest;
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
        if (request()->user()->cannot('viewAny', Faq::class)) {
            abort(403);
        }
        $faqs = Faq::with('category')->latest()->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();
        return Inertia::render('faqs/Index', [
            'faqs' => $faqs,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->user()->cannot('create', Faq::class)) {
            abort(403);
        }
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
    public function store(FaqRequest $request)
    {

        if (request()->user()->cannot('create', Faq::class)) {
            abort(403);
        }
        $validated = $request->validated();

        // Get the next order number if not provided
        $order = $validated['order'] ?? (Faq::max('order') + 1) ?? 1;

        $faq = Faq::create([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category_id' => $validated['category_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'order' => $order,
        ]);

        // Attach tags if provided
        if (!empty($validated['tags'])) {
            $faq->tags()->attach($validated['tags']);
        }

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ erfolgreich erstellt.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        if ($request->user()->cannot('update', $faq)) {
            abort(403);
        }
        $validated = $request->validated();

        // Use existing order if not provided
        $order = $validated['order'] ?? $faq->order;

        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category_id' => $validated['category_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'order' => $order,
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
        if (request()->user()->cannot('delete', $faq)) {
            abort(403);
        }
        $faq->tags()->detach(); // Remove tag relationships
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ erfolgreich gelöscht.');
    }
}
