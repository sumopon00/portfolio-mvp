<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Friendship;
use App\Models\User;

class FriendshipController extends Controller
{
    public function index() 
    {
        $pendingRequests = Friendship::where('receiver_id', auth()->id())
                                     ->where('status', 'pending')
                                     ->get();
        $friends = Friendship::where(function($query) {
            $query->where('requester_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
        })
        ->where('status', 'accepted')
        ->get();
        $tags = Tag::where('user_id', auth()->id())->get();

        return view('friends.index', compact('pendingRequests', 'friends', 'tags'));
    }

    public function store(User $user) 
    {
        $exists = Friendship::where('requester_id', auth()->id())
                            ->where('receiver_id', $user->id)
                            ->exists();

        if($exists) {
            return redirect()->route('friends.index');
        }

        Friendship::create([
            'requester_id' => auth()->id(),
            'receiver_id' => $user->id,
            'status' => 'pending',
        ]);

        return redirect()->route('friends.index');
    }

    public function accept(string $id)
    {
        $friendship = Friendship::find($id);
        $friendship->status = 'accepted';
        $friendship->save();

        return redirect()->route('friends.index');
    }

    public function reject(string $id)
    {
        $friendship = Friendship::find($id);
        $friendship->status = 'rejected';
        $friendship->save();

        return redirect()->route('friends.index');
    }

    public function search(Request $request)
    {
        $users = [];

        if($request->name) {
            $users = User::where('name', 'like', '%' . $request->name . '%')
                         ->where('id', '!=', auth()->id())
                         ->get();

        }

        return view('friends.search', compact('users'));
    }

    public
}