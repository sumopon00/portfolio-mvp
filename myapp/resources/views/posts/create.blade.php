<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿作成</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('posts.index') }}" class="text-blue-500 text-sm absolute left-4">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">新規投稿</h1>
                  <button form="post-form" type="submit" class="text-blue-500 text-sm font-bold absolute right-4 top-3">シェア</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                  <input type="file" name="image" class="text-sm w-full">
            </div>

            <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                  <textarea name="caption" placeholder="キャプションを入力..." class="w-full text-sm outline-none resize-none" rows="3"></textarea>
            </div>

            <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                  <label class="text-sm font-semibold block mb-2">公開範囲</label>
                  <select name="visibility" id="visibility" onchange="toggleTagSelect()" class="text-sm border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="all">友達全員</option>
                        <option value="tags">タグ指定</option>
                        <option value="private">自分のみ</option>
                  </select>
            </div>

            <div id="tag-select" class="bg-white border border-gray-200 mb-2 px-4 py-3" style="display:none;">
                  <label class="text-sm font-semibold block mb-2">タグ選択</label>
                  @foreach ($tags as $tag)
                        <div class="flex items-center gap-2 mb-1">
                              <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                              <label for="tag_{{ $tag->id }}" class="text-sm">{{ $tag->name }}</label>
                        </div>
                  @endforeach
            </div>

            <div class="bg-white border border-gray-200 mb-2 px-4 py-3">
                  <label class="text-sm font-semibold block mb-2">アルバム</label>
                  <select name="album_id" class="text-sm border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="0">選択しない</option>
                        @foreach ($allAlbums as $album)
                              <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                  </select>
            </div>
            </form>
      </main>

      <script>
            function toggleTagSelect() {
                  const visibility = document.getElementById('visibility').value;
                  const tagSelect = document.getElementById('tag-select');
                  tagSelect.style.display = visibility === 'tags' ? 'block' : 'none';
            }
      </script>

      <x-navigation />
</body>
</html>