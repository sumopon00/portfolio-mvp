<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム管理</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 flex items-center justify-between">
                  <h1 class="font-bold text-lg">アルバム</h1>
                  <a href="{{ route('albums.create') }}" class="text-blue-500 text-sm">＋　作成</a>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <h2 class="font-bold text-sm px-4 mb-2">私のアルバム</h2>
            <div class="bg-white border border-gray-200 mb-4">
                  @foreach ($myAlbums as $myAlbum)
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                              <div>
                                    <p class="text-sm font-semibold">{{ $myAlbum->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $myAlbum->created_at }}</p>
                              </div>
                              <div class="flex items-center gap-3">
                                    <a href="{{ route('albums.show', $myAlbum->id) }}" class="text-sm text-blue-500">詳細</a>
                                    @if ($myAlbum->user_id == auth()->id())
                                          <form action="{{ route('albums.destroy', $myAlbum->id) }}" method="POST" class="flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-500">削除</button>
                                          </form>
                                    @endif
                              </div>
                        </div>
                  @endforeach
            </div>

            <h2 class="font-bold text-sm px-4 mb-2">共有されたアルバム</h2>
            <div class="bg-white border border-gray-200">
                  @foreach ($friendAlbums as $friendAlbum)
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                              <div>
                              <p class="text-sm font-semibold">{{ $friendAlbum->name }}</p>
                              <p class="text-xs text-gray-400">{{ $friendAlbum->created_at }}</p>
                              </div>
                              <a href="{{ route('albums.show', $friendAlbum->id) }}" class="text-sm text-blue-500">詳細</a>
                        </div>
                  @endforeach
            </div>
      </main>
</body>
</html>