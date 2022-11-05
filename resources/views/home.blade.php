@extends('layouts.app')

@section('content')
<link href="{{ secure_asset('css/home.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> -->
            <div class="card py-5 text-center">
                <a class="nav-link" href="{{ route('task.create') }}">
                    <h2>
                        <i class="homeicon-stopwatch fa-solid fa-stopwatch"></i><br>
                        タスクの時間を測定して<br class="br">保存してみよう!
                    </h2>
                </a>
            </div>
            <div class="card py-5 text-center">
                <a class="nav-link" href="{{ route('mylist') }}">
                    <h2>
                        <i class="homeicon-list fa-solid fa-table-list"></i><br>
                        今までやってきた<br class="br">タスクを確認しよう!
                    </h2>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
