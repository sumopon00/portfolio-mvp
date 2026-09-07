<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム管理</title>
</head>
<body>
      <h1>アルバム一覧</h1>

      <a href="{{ route('albums.create') }}">アルバムを作成</a>

      <h2>私のアルバム</h2>
      @foreach ($myAlbums as $myAlbum)
            <div class="">
                  <p>{{ $myAlbum->name }}</p>
                  <p>{{ $myAlbum->created_at }}</p>
                  <a href="{{ route('albums.show', $myAlbum->id) }}">アルバム詳細</a>
            </div>
      @endforeach

      <h2>共有されたアルバム</h2>
      @foreach ($friendAlbums as $friendAlbum)
            <div class="">
                  <p>{{ $friendAlbum->name }}</p>
                  <p>{{ $friendAlbum->created_at }}</p>
                  <a href="{{ route('albums.show', $myAlbum->id) }}">アルバム詳細</a>
            </div>
      @endforeach
</body>
</html>