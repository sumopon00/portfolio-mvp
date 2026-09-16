<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>メンバー招待</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('albums.index') }}" class="text-blue-500 text-sm absolute left-4">スキップ</a>
                  <h1 class="font-bold text-lg text-center">{{ $album->name }}</h1>
                  <button form="member-form" type="submit" class="text-blue-500 text-sm font-bold absolute right-4 top-3">招待</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="member-form" action="{{ route('albums.members.store', $album->id) }}" method="POST">
                  @csrf
                  <div class="bg-white border border-gray-200 px-4 py-3">
                  <label class="text-sm font-semibold block mb-2">友達を招待</label>
                  <select name="friends" class="text-sm border border-gray-300 rounded px-2 py-1 w-full">
                        @foreach ($friends as $friend)
                              @php
                                    $friendId = $friend->requester_id;
                                    $friendUser = \App\Models\User::find($friendId);
                              @endphp
                        <option value="{{ $friendId }}">{{ $friendUser->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </main>
</body>
</html>