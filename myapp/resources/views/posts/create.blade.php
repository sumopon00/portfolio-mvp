<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿作成</title>
</head>
<body>
      <h1>投稿作成</h1>

      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="">
                  <label for="">写真</label>
                  <input type="file" name="image">
            </div>

            <div class="">
                  <label for="">キャプション</label>
                  <textarea name="caption" id=""></textarea>
            </div>

            <div class="">
                  <label for="">公開範囲</label>
                  <select name="visibility" id="visibility" onchange="toggleTagSelect()">
                        <option value="all">友達全員</option>
                        <option value="tags">タグ指定</option>
                        <option value="private">自分のみ</option>
                  </select>
            </div>

            <div id="tag-select" style="display:none;">
                  <label>タグ選択</label>
                  @foreach ($tags as $tag)
                        <div>
                              <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                              <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                  @endforeach
            </div>

            <script>
                  function toggleTagSelect() {
                        const visibility = document.getElementById('visibility').value;
                        const tagSelect = document.getElementById('tag-select');
                        tagSelect.style.display = visibility === 'tags' ? 'block' : 'none';
                  }
            </script>

            <div class="">
                  <label for="">アルバム</label>
                  <select name="album_id" id="">
                        <option value="0">選択しない</option>
                        @foreach ($allAlbums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                  </select>
            </div>

            <button type="submit">投稿する</button>
      </form>
</body>
</html>