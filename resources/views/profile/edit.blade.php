@extends('layouts.app')
@section('content')

{{-- メッセージ表示 --}}
@if(session('message'))
<div class="col-8 mx-auto alert alert-success">{{session('message')}}</div>
@endif

{{-- エラー表示 --}}
@if ($errors->any())
<div class="col-8 mx-auto alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container ml-auto col-12 col-md-10 col-lg-8" style="background-color:white;">
    <div class="row">
        <div class="col-md-10 mt-6 mx-auto">
            <div class="card-body">
                <h1 class="mt-4">プロフィール編集</h1>
                <form method="post" action="{{route('profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">ニックネーム</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name', $user->name)}}">
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email', $user->email)}}">
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード(8文字以上）</label>
                        <input id="password" type="password" 
                        class="form-control" name="password" placeholder="パスワードを入力してください" 
                        required autocomplete="new-password">

                    </div>

                    <div class="form-group">
                        <label for="password">パスワード再入力</label>
                        <input id="password-confirm" type="password" class="form-control" 
                        name="password_confirmation" placeholder="パスワードを再入力してください" 
                        required autocomplete="new-password">
                    </div>

                    <button type=”submit” class="btn btn-success mt-2">送信する</button>
                </form>
               
                <div class="mt-5">
                    <h4 class="mb-3">権限の設定（管理者のみ操作可能）</h4>
                    <table class="table border">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col-4" width="30%">役割</th>
                                <th scope="col-4" width="40%">付与</th>
                                <th scope="col-4" width="40%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>
                                    {{$role->name}}
                                </td>
                                <td>
                                    <form method="post" action="{{route('role.attach', $user)}}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-primary"
                                        @if($user->roles->contains($role))
                                                disabled
                                            @endif  
                                            >追加</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{route('role.detach', $user)}}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger"
                                        @if(!$user->roles->contains($role))
                                                disabled
                                            @endif  >削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
               
            </div>
        </div>      
    </div>
</div>

@endsection