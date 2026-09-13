<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumMember;
use App\Models\AlbumPost;
use App\Models\Friendship;
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
        $album = Album::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'is_shared' => $request->is_shared,
        ]);

        if($request->is_shared) {
            return redirect()->route('albums.members', $album->id);
        } else {
            return redirect()->route(('albums.index'));
        }
    }

    public function addMember(string $id)
    {
        $album = Album::find($id);
        $friends = Friendship::where(function($query) {
            $query->where('requester_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
        })
        ->where('status', 'accepted')
        ->get();

        return view('albums.addMember', compact('album', 'friends'));
    }

    public function storeMember(Request $request, string $id)
    {
        AlbumMember::create([
            'album_id' => $id,
            'user_id' => $request->friends,
        ]);

        return redirect()->route('albums.show', $id);
    }

    public function show(string $id)
    {
        $album = Album::find($id);
        $postIds = AlbumPost::where('album_id', $id)->pluck('post_id');
        $posts = Post::whereIn('id', $postIds)->get();

        return view('albums.show', compact('album', 'posts'));
    }

    public function destroy(string $id)
    {
        $album = Album::find($id);

        if ($album->user_id !== auth()->id()) {
            return redirect()->route('albums.index');
        }

        $album->delete();

        return redirect()->route('albums.index');
    }
}
