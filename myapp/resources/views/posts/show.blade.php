<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿詳細</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
      <header class="bg-white border-b border-gray-200">
                  <div class="max-w-lg mx-auto px-4 py-3 relative">
                        <a href="{{ route('posts.index') }}" class="text-blue-500 text-sm absolute left-4">戻る</a>
                        <h1 class="font-bold text-lg text-center">投稿</h1>
                  </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <div class="bg-white border border-gray-200">
                  <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full">
                  <div class="px-4 py-3">
                        <p class="text-sm">{{ $post->caption }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $post->created_at }}</p>
                  </div>

                  @if ($post->user_id == auth()->id())
                        <div class="px-4 pb-3 flex gap-2">
                              <a href="{{ route('posts.edit', $post->id) }}" class="text-sm text-blue-500">編集</a>

                              <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500">削除</button>
                              </form>
                        </div>
                  @endif
            </div>
      </main>
</body>
</html>