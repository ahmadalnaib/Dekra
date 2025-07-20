<?php


namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        
        return Inertia::render('tags/Index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('tags/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        
        return Inertia::render('tags/Show', [
            'tag' => $tag,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        
        return Inertia::render('tags/Edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')->ignore($tag->id),
            ],
        ]);

        $tag->update($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich gelöscht.');
    }
}