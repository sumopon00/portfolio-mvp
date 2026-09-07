<?php

namespace App\Http\Controllers;

use App\Models\UserTag;
use Illuminate\Http\Request;

class UserTagController extends Controller
{
    public function store(Request $request)
    {
        $exists = Usertag::where('user_id', auth()->id())
                         ->where('friend_id', $request->friend_id)
                         ->where('tag_id', $request->tag_id)
                         ->exists();

        if($exists) {
            return redirect()->route('friends.index');
        }

        UserTag::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
            'tag_id' => $request->tag_id,
        ]);

        return redirect()->route('friends.index');
    }

    public function destroy(string $id)
    {
        $tag = UserTag::find($id);

        $tag->delete();

        return redirect()->route('friends.index');
    }
}
