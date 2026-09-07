<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>アルバムメンバー管理</title>
</head>
<body>
      <p>{{ $album->name }}</p>

      <form action="{{ route('albums.members.store', $album->id) }}" method="POST">
           @csrf
           
           <div class="">
            <label for="">友達を招待</label>
            <select name="friends" id="">
                  @foreach ($friends as $friend)
                      @php
                        $friendId = $friend->requester_id == auth()->id() ? $friend->receiver_id : $friend->requester_id;
                        $friendUser = \App\Models\User::find($friendId);
                      @endphp
                      <option value="{{ $friendId }}">{{ $friendUser->name }}</option>
                  @endforeach
            </select>
           </div>

           <button type="submit">招待する</button>
      </form>
</body>
</html>