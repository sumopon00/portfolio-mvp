<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿編集</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 text-sm absolute left-4">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">投稿を編集</h1>
                  <button form="edit-form" type="submit" class="text-blue-500 text-sm font-bold absolute right-4 top-3">保存</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="edit-form" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">写真</label>
                        <input type="file" name="image" class="text-sm w-full">
                  </div>

                  <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                        <textarea name="caption" placeholder="キャプションを入力．．．" class="w-full text-sm outline-none resize-none" rows="3">{{ $post->caption }}</textarea>
                  </div>

                  <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">公開範囲</label>
                        <select name="visibility" class="text-sm border border-gray-300 rounded px-2 py-1 w-full">>
                              <option value="all" {{ $post->visibility == 'all' ? 'selected' : '' }}>友達全員</option>
                              <option value="tags" {{ $post->visibility == 'tags' ? 'selected' : '' }}>タグ指定</option>
                              <option value="private" {{ $post->visibility == 'private' ? 'selected' : '' }}>自分のみ</option>
                        </select>
                  </div>
            </form>
      </main>

      <x-navigation />
</body>
</html>