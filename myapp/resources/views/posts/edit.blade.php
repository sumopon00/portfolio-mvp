<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿編集</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-warm min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('posts.show', $post->id) }}" class="text-primary text-sm absolute left-4">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">投稿を編集</h1>
                  <button form="edit-form" type="submit" class="text-primary text-sm font-bold absolute right-4 top-3">保存</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="edit-form" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">写真</label>
                        <input type="file" name="image" class="text-sm w-full">
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <textarea name="caption" placeholder="キャプションを入力．．．" class="w-full text-sm outline-none resize-none" rows="3">{{ $post->caption }}</textarea>
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">公開範囲</label>
                        <select name="visibility" id="visibility" onchange="toggleTagSelect()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-full focus:ring-0 focus:outline-none focus:border-primary">
                              <option value="all" {{ $post->visibility == 'all' ? 'selected' : '' }}>友達全員</option>
                              <option value="tags" {{ $post->visibility == 'tags' ? 'selected' : '' }}>タグ指定</option>
                              <option value="private" {{ $post->visibility == 'private' ? 'selected' : '' }}>自分のみ</option>
                        </select>
                  </div>

                  <div id="tag-select" class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3" style="display:{{ $post->visibility == 'tags' ? 'block' : 'none' }};">
                        <label class="text-sm font-semibold block mb-2">タグ選択</label>
                        @foreach ($tags as $tag)
                              <div class="flex items-center gap-2 mb-1">
                                    <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" {{ in_array($tag->id, $selectedTagIds) ? 'checked' : '' }}>
                                    <label for="tag_{{ $tag->id }}" class="text-sm">{{ $tag->name }}</label>
                              </div>
                        @endforeach
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