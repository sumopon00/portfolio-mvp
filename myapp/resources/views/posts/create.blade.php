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
                  <select name="visibility" id="">
                        <option value="all">友達全員</option>
                        <option value="tags">タグ指定</option>
                        <option value="private">自分のみ</option>
                  </select>
            </div>

            <button type="submit">投稿する</button>
      </form>
</body>
</html>