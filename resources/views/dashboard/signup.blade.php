@extends('dashboard.template')
@section('content')
    <form action="/signup" method="post">
        <div class="ali center w-300">
            <div class="by">
                <h4 class="ty">
                    注册
                    @if(isset($msg) && !$user)
                        <label class="alert-info">{{ $msg }}</label>
                    @endif
                </h4>
                @if($user)
                    <div class="ph">
                        <label class="alert-info">{{ $msg }}</label>
                    </div>
                @else
                    <div class="ph">
                        <input class="form-control" name="email" type="email" placeholder="请输入邮箱">
                    </div>
                    <div class="ph">
                        <input class="form-control" name="name" type="text" placeholder="请输入昵称">
                    </div>
                    <div class="ph">
                        <input class="form-control" name="password" type="password" placeholder="请输入密码">
                    </div>
                @endif
            </div>
            @if(!$user)
                <button type="submit" class="ce apn ame fr f14">注&nbsp;册</button>
            @else
                <button type="button" class="ce apn ame fr f14" onclick="location.href='/login';">现在登录</button>
            @endif
        </div>
    </form>
@endsection