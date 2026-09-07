<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>タグ管理</title>
</head>
<body>
      <h1>タグ管理</h1>

      @if ($errors->any())
            <div>
                  @foreach ($errors->all() as $error)
                        <p style="color:red;">{{ $error }}</p>
                  @endforeach
            </div>
      @endif

      <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="新しいタグ名を入力">
            <button type="submit">タグを作成</button>
      </form>

      @foreach ($tags as $tag)
          <p>{{ $tag->name }}</p>
          <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
          </form>
      @endforeach
</body>
</html>