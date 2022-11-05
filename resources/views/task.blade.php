@extends('layouts.app')
@section('content')
<link href="{{ secure_asset('css/task.css') }}" rel="stylesheet">
<div class="container-fluid " ontouchstart="">
  <div class="row align-items-center jusitfy-content-center ">
    <h1 class="text-center fw-bold tasktitle">Task</h1>
    @if(@session('message'))
    <div class="task-message alert alert-success col-md-10 offset-md-1 mx-auto"> {{session('message')}} </div>
    @endif
    @if($errors->any())
      <div class="task-message alert alert-danger col-md-10 offset-md-1 mx-auto">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form method="post" action="{{route('task.store')}}" class="container mx-auto align-items-center jusitfy-content-center " enctype="multipart/form-data">
      @csrf
      <div class="container mx-auto col-md-10 offset-md-1 row align-items-center jusitfy-content-center border-primary">
        <div class="form-group col-md-6 align-items-center jusitfy-content-center">
          <h4 class="text-center mb-0 pb-0">Please enter the task<i class="ms-1 fa-solid fa-pen"></i></h4>  
          <textarea name="body" type="body" class="form-control mb-2 border border-3 border-secondary" rows="6"  placeholder="タスクを入力してください">{{old('body')}}</textarea>
        </div>
        <div class="container mx-auto timer col-md-6 ">
          <h1 id="time" class="time text-center border border-info border-3 rounded-pill mx-auto  p-3">00:00:00.000</h1>
            <div class="timerswitch text-center">
              <button type="button" id="start" value="start" class="button mx-2 start">
                <i class="fa-solid fa-play"></i>
              </button>
              <button type="button" id="stop" value="stop" class="button mx-2 stop">
                <i class="fa-solid fa-stop"></i>
              </button>
              <button type="button" id="reset" value="reset" class="button mx-2 reset">
                <i class="fa-solid fa-arrow-rotate-left"></i>
              </button>
            </div>
          <input type="hidden" name="taketime" id="taketime" value="測定していない">
        </div>
      </div>
      <button id="send" type="submit" value="Send the data" class="submit rounded-pill  col-md-2 offset-md-5">
        <i class="fa-solid fa-upload me-3"></i>Send 
      </button>
        <script>
          const time = document.getElementById('time');
          const startSwitch = document.getElementById('start');
          const stopSwitch = document.getElementById('stop');
          const resetSwitch = document.getElementById('reset');
          const send = document.getElementById('send');

          let startDate;
          let stopTime = 0;
          let timeoutID;

          var clickEventType = (( window.ontouchstart!==null) ? 'click' : 'touchend' );
          
          function displayTime(){
            const currentTime = new Date(Date.now() - startDate + stopTime);
            const h = String(currentTime.getHours()-9).padStart(2, '0');
            const m = String(currentTime.getMinutes()).padStart(2, '0');
            const s = String(currentTime.getSeconds()).padStart(2, '0');
            const ms = String(currentTime.getMilliseconds()).padStart(3, '0');
            
            time.textContent = `${h}:${m}:${s}.${ms}`;
            let taketime = `${h}:${m}:${s}.${ms}`;
            document.getElementById('taketime').value = taketime;
            timeoutID = setTimeout(displayTime, 5);

          }

          startSwitch.addEventListener(clickEventType, ()=>{
            startSwitch.disabled = true;
            stopSwitch.disabled = false;
            resetSwitch.disabled = true;
            startDate = Date.now();
            displayTime();
          });

          stopSwitch.addEventListener(clickEventType, ()=>{
            startSwitch.disabled = false;
            stopSwitch.disabled = true;
            resetSwitch.disabled = false;
            clearTimeout(timeoutID);
            stopTime += (Date.now() - startDate);

          });

          resetSwitch.addEventListener(clickEventType, ()=>{
            startSwitch.disabled = false;
            stopSwitch.disabled = true;
            resetSwitch.disabled = true;
            time.textContent = '00:00:00.000';
            stopTime = 0;
          });

          send.addEvenetListener(clickEventType, ()=>{});
        </script>
        
    </form>
  </div>
</div>
@endsection 