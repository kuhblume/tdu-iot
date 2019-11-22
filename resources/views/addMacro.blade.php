@extends('layouts.app')
<link href="{{ asset('css/addmacro.css') }}" rel="stylesheet">
@section('content')
    <div align="center">
        <h3>ボタン一覧</h3>
        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($devices as $device)
                <div class="card">
                    <div class="card-header" style="transform: rotate(0);" role="tab" id="heading{{$device->id}}">
                        <h5 class="mb-0">
                            <a class="text-body collapsed stretched-link text-decoration-none" data-toggle="collapse" href="#collapse{{$device->id}}" role="button" aria-expanded="false" aria-controls="collapseOne">
                                {{$device->name}}
                            </a>
                        </h5>
                    </div>
                    <div id="collapse{{$device->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$device->id}}" data-parent="#accordion">
                        <div class="card-body">
                            @foreach($device->button as $button)
                                <button class="button2" onclick="add('{{$button->id}}','{{$button->name}}','{{$device->name}}')">{{$button->name}}</button><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <label>マクロ名：
            <input id="macro_name" type="text" name="macro_name" required>
        </label>
        <h3>実行リスト</h3>
        <div id="order-list"></div>
        <button class="button" onclick="send()">マクロ作成</button>
    </div>
    <script type="text/javascript">
        let calls = [];//呼び出し順に配列に格納

        function add(buttonId,buttonName,deviceName) {
            calls.push({buttonId:buttonId,buttonName:buttonName,deviceName:deviceName});
            updateElement();
        }
        function remove(index) {
            calls.splice(index, 1);
            updateElement();
        }
        function updateElement() {
            let body = "";
            calls.forEach((items,index)=>{
                body = body + "<div>"+(items.deviceName)+" : "+items.buttonName+"<button onclick='remove("+index+")'>remove</button>"+"</div>";
                // console.log(calls);
            });
            document.getElementById('order-list').innerHTML = body;
        }
        function send() {
            let send = [];
            let macroName = document.getElementById('macro_name').value;
            if(macroName==="")return;
            calls.forEach((items,index)=>{
                send.push({
                    number:index,
                    buttonId:items.buttonId,
                    buttonName:items.buttonName
                })
            });

            let csrf = document.getElementsByName('csrf-token').item(0).content;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // console.log(this.responseText);
                    document.location.href = '{{ Request::root()}}';//ページ遷移用
                } else if (this.readyState === 4) {
                    console.error(this.responseText);
                }
            };
            xhr.open('POST', '{{ Request::root()}}/macro/add');
            xhr.setRequestHeader( 'Content-Type', 'application/json');
            xhr.setRequestHeader( 'X-CSRF-Token', csrf );
            xhr.send(JSON.stringify({buttons:send,name:macroName}));
            // console.log(JSON.stringify(calls));
        }
    </script>

    {{--    <div id="app">--}}
    {{--        <example-component></example-component>--}}
    {{--    </div>--}}

@endsection
