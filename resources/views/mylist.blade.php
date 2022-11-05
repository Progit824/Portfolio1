@extends('layouts.app')
@section('content')
<link href="{{ secure_asset('css/mylist.css') }}" rel="stylesheet">
<table class="container mx-auto col-md-10 offset-md-1 ">
        <tr class="table-heading">
          <th class="smart-phone-heading"></th>
          <th scope="col" class="tabletask text-center">タスク</th>
          <th scope="col" class="tablecreatedate">完了日時</th>
          <th scope="col" class="tabletaketime">かかった時間</th>
          <th scope="col" class="tabledelete border">削除ボタン</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
          <td class="smart-phone-content">タスク</td>
          <td data-label="タスク">{{Crypt::decryptString($task->body)}}</td>
          <td data-label="完了日時">{{$task->created_at}}</td>
          <td data-label="かかった時間">{{$task->taketime}}</td>
          <form method="post" action="{{route('task.destroy',$task)}}">
            @csrf
            @method('delete')
            <td>
              <button id="deletebutton" type="submit" value="削除" onClick="return confirm('本当に削除しますか？');">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </form>
        </tr>
        @endforeach
</table>

@endsection