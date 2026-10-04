<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Album;
use App\Models\AlbumMember;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function mypage(Request $request)
    {
        $now = Carbon::now();
        $year = $request->year ?? $now->year;
        $month = $request->month ?? $now->month;
        $showMonth = Carbon::create($year, $month, 1);
        $daysInMonth = $showMonth->daysInMonth;
        $firstDayOfWeek = $showMonth->startOfMonth()->dayOfWeek;

        $user = auth()->user();
        $myPosts = Post::where('user_id', auth()->id())
                       ->whereYear('created_at', $year)
                       ->whereMonth('created_at', $month)
                       ->get();
        $postsByDay = $myPosts->groupBy(function($post) {
            return $post->created_at->day;
        });
        $myAlbums = Album::where('user_id', auth()->id())->get();
        $friendAlbumIds = AlbumMember::where('user_id', auth()->id())
                             ->pluck('album_id');
        $sharedAlbums = Album::whereIn('id', $friendAlbumIds)->get();

        return view('profile.mypage', compact('now', 'showMonth', 'daysInMonth', 'firstDayOfWeek', 'user', 'myPosts', 'postsByDay', 'myAlbums', 'sharedAlbums'));
    }
}
