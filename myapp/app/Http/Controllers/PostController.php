<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPost;
use App\Models\Friendship;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friendships = Friendship::where(function($query) {
            $query->where('requester_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
        })
        ->where('status', 'accepted')
        ->get();

        $friendIds = $friendships->map(function($friendship) {
            return $friendship->requester_id == auth()->id() 
                ? $friendship->receiver_id 
                : $friendship->requester_id;
        });

        $myTagIds = UserTag::where('friend_id', auth()->id())
                           ->pluck('tag_id');

        $posts = Post::where('user_id', auth()->id())
                     ->orWhere(function($query) use ($friendIds) {
                        $query->whereIn('user_id', $friendIds)
                              ->where('visibility', 'all');
                     })
                     ->orWhere(function($query) use ($friendIds, $myTagIds) {
                        $query->whereIn('user_id', $friendIds)
                              ->where('visibility', 'tags')
                              ->whereIn('id',
                                PostTag::whereIn('tag_id', $myTagIds)->pluck('post_id')
                                );
                     })
                     ->get();
    
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = Album::where('user_id', auth()->id())->get();
        $tags = Tag::where('user_id', auth()->id())->get();
        return view('posts.create', compact('albums', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagePath = $request->file('image')->store('posts', 'public');

        $post = Post::create([
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'caption' => $request->caption,
            'visibility' => $request->visibility,
        ]);

        if($request->album_id) {
            AlbumPost::create([
                'album_id' => $request->album_id,
                'post_id' => $post->id,
            ]);
        }

        if($request->tag_id) {
            foreach($request->tag_id as $tagId) {
                PostTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tagId,
                ]);
            }
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image_path = $imagePath;
        }

        $post->caption = $request->caption;
        $post->visibility = $request->visibility;
        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index');
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
