<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumMember;
use App\Models\AlbumPost;
use App\Models\Post;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $myAlbums = Album::where('user_id', auth()->id())->get();

        $friendAlbumIds = AlbumMember::where('user_id', auth()->id())
                                     ->pluck('album_id');

        $friendAlbums = Album::whereIn('id', $friendAlbumIds)->get();

        return view('albums.index', compact('myAlbums', 'friendAlbums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request) {
        Album::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'is_shared' => $request->is_shared,
        ]);

        if($request->is_shared) {
            return redirect()->route(('albums.index'));
        } else {
            return redirect()->route(('albums.index'));
        }
    }

    public function show(string $id)
    {
        $album = Album::find($id);
        $postIds = AlbumPost::where('album_id', $id)->pluck('post_id');
        $posts = Post::whereIn('id', $postIds)->get();

        return view('albums.show', compact('album', 'posts'));
    }
}
