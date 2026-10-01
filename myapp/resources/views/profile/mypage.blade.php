<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>マイページ</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3">
                  <h1 class="text-center font-bold text-lg text-black">マイページ</h1>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <div class="bg-white shadow-sm rounded-xl mb-4 px-4 py-5">
                  <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex-shrink-0"></div>
                        <div>
                              <p class="font-bold text-base">{{ $user->name }}</p>
                              <p class="text-xs text-gray-400 mt-1">{{ $user->email }}</p>
                        </div>
                  </div>
                  <a href="{{ route('profile.edit') }}" class="block text-center text-sm border border-gray-200 rounded-lg py-2 mt-4 text-gray-600">
                        プロフィールを編集
                  </a>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-4">
                  <div class="flex border-b border-gray-200">
                        <button onclick="switchTab('posts')" id="tab-posts" class="flex-1 py-3 text-sm font-semibold text-primary border-b-2 border-primary">
                              投稿
                        </button>
                        <button onclick="switchTab('albums')" id="tab-albums" class="flex-1 py-3 text-sm font-semibold text-gray-400">
                              アルバム
                        </button>
                  </div>

                  <div id="content-posts" class="max-w-lg mx-auto pt-4">
                        <div class="grid grid-cols-3 gap-1">
                              @foreach ($myPosts as $myPost)
                                  <div>
                                    <a href="{{ route('posts.show', $myPost->id) }}">
                                          <img src="{{ asset('storage/' . $myPost->image_path) }}" class="w-full aspect-square object-cover">
                                    </a>
                                  </div>
                              @endforeach
                        </div>
                  </div>

                  <div id="content-albums" class="hidden">
                        <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-4">
                              @foreach ($myAlbums as $myAlbum)
                                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                                          <div>
                                                <p class="text-sm font-semibold">{{ $myAlbum->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $myAlbum->created_at->diffForHumans() }}</p>
                                          </div>
                                          <div class="flex items-center gap-3">
                                                <a href="{{ route('albums.show', $myAlbum->id) }}" class="text-sm text-primary">詳細</a>
                                                @if ($myAlbum->user_id == auth()->id())
                                                      <form action="{{ route('albums.destroy', $myAlbum->id) }}" method="POST" class="flex">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs text-danger">削除</button>
                                                      </form>
                                                @endif
                                          </div>
                                    </div>
                              @endforeach

                              @foreach ($sharedAlbums as $sharedAlbum)
                                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                                          <div>
                                                <p class="text-sm font-semibold">{{ $sharedAlbum->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $sharedAlbum->created_at->diffForHumans() }}</p>
                                          </div>
                                          <a href="{{ route('albums.show', $sharedAlbum->id) }}" class="text-sm text-primary">詳細</a>
                                    </div>
                              @endforeach
                        </div>
                  </div>
            </div>
      </main>

      <script>
            function switchTab(tab) {
                  document.getElementById('tab-posts').classList.remove('text-primary', 'border-b-2', 'border-primary');
                  document.getElementById('tab-posts').classList.add('text-gray-400');
                  document.getElementById('tab-albums').classList.remove('text-primary', 'border-b-2', 'border-primary');
                  document.getElementById('tab-albums').classList.add('text-gray-400');

                  document.getElementById('content-posts').classList.add('hidden');
                  document.getElementById('content-albums').classList.add('hidden');

                  document.getElementById('tab-' + tab).classList.remove('text-gray-400');
                  document.getElementById('tab-' + tab).classList.add('text-primary', 'border-b-2', 'border-primary');

                  document.getElementById('content-' + tab).classList.remove('hidden');


            }
      </script>

      <x-navigation />
</body>
</html>