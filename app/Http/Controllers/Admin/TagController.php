<?php


namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->user()->cannot('viewAny', Tag::class)) {
            abort(403);
        }
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
         if (request()->user()->cannot('create', Tag::class)) {
            abort(403);
        }
        return Inertia::render('tags/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
         if (request()->user()->cannot('create', Tag::class)) {
            abort(403);
        }
        $validated = $request->validated();

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich erstellt.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        if (request()->user()->cannot('update', $tag)) {
            abort(403);
        }
        
        $validated = $request->validated();

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
        if (request()->user()->cannot('delete', $tag)) {
            abort(403);
        }
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich gelöscht.');
    }
}
