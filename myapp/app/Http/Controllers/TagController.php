<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', auth()->id())->get();
        return view('tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        return redirect()->route('tags.index');
    }

    public function destroy(string $id)
    {
        $tag = Tag::find($id);

        $tag->delete();

        return redirect()->route('tags.index');
    }
}
