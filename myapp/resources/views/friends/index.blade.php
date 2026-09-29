<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>友達管理</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 flex items-center justify-between">
                  <h1 class="text-center font-bold text-lg">友達</h1>
                  <a href="{{ route('tags.index') }}" class="text-primary text-sm">タグ管理</a>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <div class="max-w-lg mx-auto px-4 py-3">
                  <form action="{{ route('friends.index') }}" method="GET" class="flex gap-2">
                        @csrf
                        <input type="text" name="name" placeholder="ユーザー名で検索" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                        <button type="submit" class="bg-primary text-white text-sm px-4 py-2 rounded">検索</button>
                  </form>
            </div>

            @if ($searchQuery)
                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-4">
                        @foreach ($users as $user)
                              <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center">
                                          <div class="w-8 h-8 rounded-full bg-gray-300 mr-3"></div>
                                          <p class="text-sm font-semibold">{{ $user->name }}</p>
                                    </div>

                                    @php
                                    $exists = App\Models\Friendship::where(function($query) use ($user) {
                                          $query->where('requester_id', auth()->id())
                                                ->where('receiver_id', $user->id);
                                    })->orwhere(function($query) use ($user) {
                                          $query->where('requester_id', $user->id)
                                                ->where('receiver_id', auth()->id());
                                    })->exists();
                                    @endphp

                                    @if ($exists)
                                          <button disabled class="text-xs text-gray-400 border border-gray-300 px-3 py-1 rounded">申請済み</button>
                                    @else
                                          <form action="{{ route('friends.store', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs bg-black text-white px-3 py-1 rounded">友達申請</button>
                                          </form>
                                    @endif
                              </div>
                        @endforeach
                  </div>
            @else
                  @if ($pendingRequests->count() > 0)
                        <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-4 px-4 py-3">
                              <h2 class="font-bold text-sm mb-3">友達申請</h2>
                              @foreach ($pendingRequests as $pendingRequest)
                                    <div class="flex items-center justify-between py-2">
                                          <p class="text-sm">{{ $pendingRequest->requester->name }}</p>
                                          <div class="flex gap-2">
                                                <form action="{{ route('friends.accept', $pendingRequest->id) }}" method="POST">
                                                      @csrf
                                                      @method('PATCH')
                                                      <button type="submit" class="text-sm bg-primary text-white px-3 py-1 rounded">承認</button>
                                                </form>

                                                <form action="{{ route('friends.reject', $pendingRequest->id) }}" method="POST">
                                                      @csrf
                                                      @method('PATCH')
                                                      <button type="submit" class="text-sm border border-gray-300 px-3 py-1 rounded">拒否</button>
                                                </form>
                                          </div>
                                    </div>
                              @endforeach
                        </div>
                  @endif

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                        <h2 class="font-bold text-sm px-4 py-3 border-b border-gray-200">友達</h2>
                        @foreach ($friends as $friend)
                              <div class="px-4 py-3 border-b border-gray-200">
                                    <div class="flex items-center justify-between mb-2">
                                    <div>
                                          @if ($friend->requester_id == auth()->id())
                                                <p class="text-sm font-semibold">{{ $friend->receiver->name }}</p>
                                          @else
                                                <p class="text-sm font-semibold">{{ $friend->requester->name }}</p>
                                          @endif

                                          @php
                                                $friendId = $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id;
                                                $userTags = \App\Models\UserTag::where('user_id', auth()->id())
                                                                              ->where('friend_id', $friendId)
                                                                              ->get();
                                          @endphp

                                          <div class="flex gap-1 mt-1">
                                                @foreach ($userTags as $userTag)
                                                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full">{{ $userTag->tag->name }}</span>
                                                @endforeach
                                          </div>
                                    </div>

                                    <form action="{{ route('friends.destroy', $friend->id) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="text-xs text-danger">削除</button>
                                    </form>
                                    </div>

                                    <form action="{{ route('user_tags.store') }}" method="POST" class="flex gap-2">
                                    @csrf
                                    <select name="tag_id" class="text-sm border border-gray-300 rounded px-2 py-1">
                                          @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                          @endforeach
                                    </select>
                                    <input type="hidden" name="friend_id" value="{{ $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id }}">
                                    <button type="submit" class="text-sm bg-gray-100 px-3 py-1 rounded">タグ設定</button>
                                    </form>
                              </div>
                        @endforeach
                  </div>
            @endif
      </main>

      <x-navigation />
</body>
</html>