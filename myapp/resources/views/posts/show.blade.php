<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿詳細</title>
</head>
<body>
      <h1>投稿詳細</h1>

      <div class="">
            <img src="{{ asset('storage/' . $post->image_path) }}" width="300">
            <p>{{ $post->caption }}</p>
            <p>{{ $post->created_at }}</p>
      </div>

      @if ($post->user_id == auth()->id())
          <a href="{{ route('posts.edit', $post->id) }}">編集</a>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit">削除</button>
            </form>
      @endif
</body>
</html>