<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム詳細</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
          <div class="max-w-lg mx-auto px-4 py-3 relative">
              <a href="{{ route('albums.index') }}" class="text-blue-500 text-sm absolute left-4">← 戻る</a>
              <h1 class="font-bold text-lg text-center">{{ $album->name }}</h1>
              @if ($album->user_id == auth()->id())
                  <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="absolute right-4 top-3">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 text-sm">削除</button>
                  </form>
              @endif
          </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
        <div class="grid grid-cols-3 gap-1">
            @foreach ($posts as $post)
                <div>
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full aspect-square object-cover">
                </div>
            @endforeach
        </div>
</main>
</body>
</html>