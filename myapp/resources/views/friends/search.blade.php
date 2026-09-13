<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿検索</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3">
                  <h1 class="font-bold text-lg text-center mb-3">ユーザー検索</h1>
                  <form action="{{ route('friends.search') }}" method="GET" class="flex gap-2">
                        <input type="text" name="name" placeholder="ユーザー名で検索" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                        <button type="submit" class="bg-black text-white text-sm px-4 py-2 rounded">検索</button>
                  </form>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <div class="bg-white border border-gray-200">
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
      </main>
</body>
</html>