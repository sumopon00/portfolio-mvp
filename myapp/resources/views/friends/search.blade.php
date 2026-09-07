<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>投稿検索</title>
</head>
<body>
      <form action="{{ route('friends.search') }}" method="GET">
            <input type="text" name="name" placeholder="ユーザー名で検索">
            <button type="submit">検索</button>
      </form>

      @foreach ($users as $user)
          <p>{{ $user->name }}</p>

            @php
                $exists = App\Models\Friendship::where(function($query) use ($user) {
                  $query->where('requester_id', auth()->id())
                        ->where('receiver_id', $user->id);
                })->orwhere(function($query) use ($user) {
                  $query->where('requester_id', $user->id)
                        ->where('receiver_id', auth()->id());
                })->exists();
            @endphp

            @if ($exists)
                <button disabled>申請済み</button>
            @else
                  <form action="{{ route('friends.store', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit">友達申請</button>
                  </form>
            @endif
      @endforeach
</body>
</html>