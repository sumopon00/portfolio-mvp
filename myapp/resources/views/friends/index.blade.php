<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>友達管理</title>
</head>
<body>
      <h1>友達管理</h1>

      @foreach ($pendingRequests as $pendingRequest)
            <p>{{ $pendingRequest->requester->name }}</p>

            <form action="{{ route('friends.accept', $pendingRequest->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit">承認</button>
            </form>

            <form action="{{ route('friends.reject', $pendingRequest->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit">拒否</button>
            </form>
      @endforeach

      @foreach ($friends as $friend)
            @if ($friend->requester_id == auth()->id())
                <p>{{ $friend->receiver->name }}</p>
            @else
                <p>{{ $friend->requester->name }}</p>
            @endif

            @php
                  $friendId = $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id;
                  $userTags = \App\Models\UserTag::where('user_id', auth()->id())
                                                 ->where('friend_id', $friendId)
                                                 ->get();
            @endphp

            @foreach ($userTags as $userTag)
                  <p>{{ $userTag->tag->name }}</p>
            @endforeach
            
            <form action="{{ route('user_tags.store') }}" method="POST">
                  @csrf
                  <select name="tag_id">
                        @foreach ($tags as $tag)
                              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                  </select>
                  <input type="hidden" name="friend_id" value="{{ $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id }}">
                  <button type="submit">タグ設定</button>
            </form>

            <form action="{{ route('friends.destroy', $friend->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit">削除</button>
            </form>
      @endforeach
</body>
</html>