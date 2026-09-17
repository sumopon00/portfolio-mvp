<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>タグ管理</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3">
                  <h1 class="text-center font-bold text-lg">タグ管理</h1>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            @if ($errors->any())
                  <div class="bg-red-50 border border-red-200 px-4 py-3 mb-4 rounded">
                        @foreach ($errors->all() as $error)
                        <p class="text-sm text-red-500">{{ $error }}</p>
                        @endforeach
                  </div>
            @endif

            <div class="bg-white border border-gray-200 px-4 py-3 mb-4">
                  <form action="{{ route('tags.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="name" placeholder="新しいタグ名を入力" class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm">
                        <button type="submit" class="bg-black text-white text-sm px-4 py-2 rounded">作成</button>
                  </form>
            </div>

            <div class="bg-white border border-gray-200">
                  @foreach ($tags as $tag)
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                        <p class="text-sm">{{ $tag->name }}</p>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-xs text-red-500">削除</button>
                        </form>
                        </div>
                  @endforeach
            </div>
      </main>

      <x-navigation />
</body>
</html>