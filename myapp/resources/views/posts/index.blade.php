<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿一覧</title>
</head>
<body>
      <h1>投稿一覧</h1>

      @foreach ($posts as $post)
            <div class="">
                  <p>{{ $post->user->name }}</p>
                  <img src="{{ asset('storage/' . $post->image_path) }}" width="300">
                  <p>{{ $post->caption }}</p>
                  <p>{{ $post->created_at }}</p>
            </div>

            <a href="{{ route('posts.show', $post->id) }}">詳細を見る</a>
      @endforeach
</body>
</html>