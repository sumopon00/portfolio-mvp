<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿一覧</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
                  <div class="max-w-lg mx-auto px-4 py-3">
                        <h1 class="text-center font-bold text-lg text-primary">AppName</h1>
                  </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            @foreach ($posts as $post)
                  <div class="bg-white border border-gray-200 mb-4">
                        <div class="flex items-center px-4 py-3">
                              <div class="w-8 h-8 rounded-full bg-gray-300 mr-3"></div>
                              <p class="font-semibold text-sm">{{ $post->user->name }}</p>
                        </div>
                        <a href="{{ route('posts.show', $post->id) }}" class="text-sm text-blue-500">
                              <img src="{{ asset('storage/' . $post->image_path) }}" class="w-full">
                        </a>
                        <div class="px-4 py-3">
                              <p class="text-sm">{{ $post->caption }}</p>
                              <p class="text-xs text-gray-400 mt-1">{{ $post->created_at }}</p>
                        </div>
                  </div>
            @endforeach
      </main>

      <x-navigation />
</body>
</html>