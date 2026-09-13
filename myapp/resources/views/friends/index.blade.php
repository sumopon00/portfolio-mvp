<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>友達管理</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3">
                  <h1 class="text-center font-bold text-lg">友達</h1>
            </div>
      </header>
      <main class="max-w-lg mx-auto pt-4">
            <div class="bg-white border border-gray-200 mb-4 px-4 py-3">
                  <h2 class="font-bold text-sm mb-3">友達申請</h2>
                  @foreach ($pendingRequests as $pendingRequest)
                        <div class="flex items-center justify-between py-2">
                              <p class="text-sm">{{ $pendingRequest->requester->name }}</p>
                              <div class="flex gap-2">
                                    <form action="{{ route('friends.accept', $pendingRequest->id) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <button type="submit" class="text-sm bg-black text-white px-3 py-1 rounded">承認</button>
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

            <div class="bg-white border border-gray-200">
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
                                    <button type="submit" class="text-xs text-red-500">削除</button>
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
      </main>
</body>
</html>