<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム作成</title>
</head>
<body>
      <form action="{{ route('albums.store') }}" method="POST">
            @csrf
            <div class="">
                  <label for="">名前</label>
                  <input type="text" name="name">
            </div>

            <div class="">
                  <label for="">共有</label>
                  <select name="is_shared" id="">
                        <option value="0">個人</option>
                        <option value="1">共有</option>
                  </select>
            </div>

            <button type="submit">作成する</button>
      </form>
</body>
</html>