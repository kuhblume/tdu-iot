@extends('layouts.app')
<link href="{{ asset('css/study.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/userpage1.js') }}" defer></script>
@section('content')
    <form name="set_name">
        <div class="inp">
            <br><br><p>ボタン名を入力してください</p>
            <input class="btn_name" type="text" name="button_name" placeholder="ボタン名" required maxlength="8" size="30vw" rows="1">
            <input type="hidden" name="device_id" value="{{$device_id}}">
            <br>
            <br>
            <p class="message">
                学習開始ボタンを押し、ビープ音が鳴ったら、機器に向けて記憶させたいボタンを押してください。<br>
                ボタン作成後、一度動作確認をして、動かなかったらボタンを削除し、もう一度学習してください。<br>
                注)エアコンは温度、風量等データを一括で送信しているため、温度上下のみ等の利用はできません。
            </p>
            <br><br>
            <div align="center">
{{--                <input id="study_start" type="button" value="学習開始" class="button" onclick="">--}}
{{--                <input id="study_start" type="button" value="学習開始" class="button" onclick="location.href='{{url('/button/study/'.$button->id)}}'">--}}
                <form method="POST" action="{{ action('HomeController@addDevice')}}">{{--コントローラ名--}}
                    @csrf
                    <input type=hidden name="device_id" value="{{$device_id}}">
                    <button type="submit" class="button">追加</button>
                </form>
            </div>
        </div>
    </form>
@endsection
