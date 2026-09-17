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
                  <a href="{{ route('albums.index') }}" class="text-blue-500 text-sm absolute left-4">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">新規アルバム</h1>
                  <button form="album-form" type="submit" class="text-blue-500 text-sm font-bold absolute right-4 top-3">作成</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="album-form" action="{{ route('albums.store') }}" method="POST">
                  @csrf

                  <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                        <input type="text" name="name" placeholder="アルバム名を入力" class="w-full text-sm outline-none">
                  </div>

                  <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">タイプ</label>
                        <select name="is_shared" class="text-sm border border-gray-300 rounded px-2 py-1 w-full">
                              <option value="0">個人</option>
                              <option value="1">共有</option>
                        </select>
                  </div>
            </form>
      </main>

      <x-navigation />
</body>
</html>