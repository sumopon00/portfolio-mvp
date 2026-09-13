<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバム詳細</title>
</head>
<body>
      <p>{{ $album->name }}</p>
      @foreach ($posts as $post)
          <div class="">
            <img src="{{ asset('storage/' . $post->image_path) }}" width="300">
            <p>{{ $post->caption }}</p>
            <p>{{ $post->created_at }}</p>
          </div>
      @endforeach

      @if ($album->user_id == auth()->id())
          <form action="{{ route('albums.destroy', $album->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
          </form>
      @endif

      <a href="{{ route('albums.index') }}">戻る</a>
</body>
</html>