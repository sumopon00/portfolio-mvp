<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム作成</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('albums.index') }}" class="text-primary text-sm absolute left-4">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">新規アルバム</h1>
                  <button form="album-form" type="submit" class="text-primary text-sm font-bold absolute right-4 top-3">作成</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="album-form" action="{{ route('albums.store') }}" method="POST">
                  @csrf

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <input type="text" name="name" placeholder="アルバム名を入力" class="w-full text-sm outline-none focus:outline-none">
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">タイプ</label>
                        <select name="is_shared" id="visibility" onchange="toggleFriendSelect()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-full focus:ring-0 focus:outline-none focus:border-primary">
                              <option value="0">個人</option>
                              <option value="1">共有</option>
                        </select>
                  </div>

                  <div id="friend-select" class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3" style="display:none;">
                        <label class="text-sm font-semibold block mb-2">友達選択</label>
                        @foreach ($friends as $friend)
                            <div class="flex items-center gap-2 mb-1">
                                    @php
                                          $friendId = $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id;
                                          $friendUser = \App\Models\User::find($friendId);
                                    @endphp

                                    <input type="checkbox" class="accent-primary" name="friend_id[]" value="{{ $friendId }}">
                                    <label>{{ $friendUser->name }}</label>
                            </div>
                        @endforeach
                  </div>
            </form>
      </main>

      <script>
            function toggleFriendSelect() {
                  const visibility = document.getElementById('visibility').value;
                  const friendSelect = document.getElementById('friend-select');
                  friendSelect.style.display = visibility === '1' ? 'block' : 'none';
            }
      </script>

      <x-navigation />
</body>
</html>