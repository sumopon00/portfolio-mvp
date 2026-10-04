<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿作成</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-warm min-h-screen pb-16">
      <header class="bg-white border-b border-gray-200">
            <div class="max-w-lg mx-auto px-4 py-3 relative">
                  <a href="{{ route('posts.index') }}" class="text-gray-500 text-sm absolute left-4 mt-1">キャンセル</a>
                  <h1 class="font-bold text-lg text-center">新規投稿</h1>
                  <button form="post-form" type="submit" class="text-primary text-sm font-bold mt-1 absolute right-4 top-3">シェア</button>
            </div>
      </header>

      <main class="max-w-lg mx-auto pt-4">
            <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2">
                        <label for="image" class="block px-4 py-8 text-center cursor-pointer">
                              <div id="upload-text" class="text-gray-400 text-sm">📷 写真を選択</div>
                              <div id="preview-area" class="hidden">
                                    <img id="preview-image" src="" class="w-full rounded-lg">
                                    <p class="text-xs text-danger mt-2" onclick="clearImage()">写真を削除</p>
                              </div>
                        </label>
                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <textarea name="caption" placeholder="キャプションを入力..." class="w-full text-sm outline-none resize-none" rows="3"></textarea>
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">公開範囲</label>
                        <select name="visibility" id="visibility" onchange="toggleTagSelect()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-full focus:ring-0 focus:border-primary">
                              <option value="all">友達全員</option>
                              <option value="tags">タグ指定</option>
                              <option value="private">自分のみ</option>
                        </select>
                  </div>

                  <div id="tag-select" class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3" style="display:none;">
                        <label class="text-sm font-semibold block mb-2">タグ選択</label>
                        @foreach ($tags as $tag)
                              <div class="flex items-center gap-2 mb-1">
                                    <input type="checkbox" class="accent-primary" name="tag_id[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                                    <label for="tag_{{ $tag->id }}" class="text-sm">{{ $tag->name }}</label>
                              </div>
                        @endforeach
                  </div>

                  <div class="bg-white shadow-sm rounded-xl overflow-hidden mb-2 px-4 py-3">
                        <label class="text-sm font-semibold block mb-2">アルバム</label>
                        <select name="album_id" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-full focus:ring-0 focus:border-primary">
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

            function previewImage(input) {
                  if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                              document.getElementById('preview-image').src = e.target.result;
                              document.getElementById('preview-area').classList.remove('hidden');
                              document.getElementById('upload-text').classList.add('hidden');
                        }
                        reader.readAsDataURL(input.files[0]);
                  }
            }

            function clearImage() {
                  document.getElementById('image').value = '';
                  document.getElementById('preview-area').classList.add('hidden');
                  document.getElementById('upload-text').classList.remove('hidden');
            }
      </script>

      <x-navigation />
</body>
</html>