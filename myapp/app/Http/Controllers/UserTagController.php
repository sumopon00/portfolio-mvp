<?php

namespace App\Http\Controllers;

use App\Models\UserTag;
use Illuminate\Http\Request;

class UserTagController extends Controller
{
    public function store(Request $request)
    {
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
