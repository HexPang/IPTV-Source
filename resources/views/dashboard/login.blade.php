@extends('dashboard.template')
@section('content')
    <form action="/dashboard/login" method="post">
        <div class="ali center w-300">
            <div class="by">
                <h4 class="ty">
                    登录
                    @if(isset($msg))
                        <label class="alert-info">{{ $msg }}</label>
                    @endif
                </h4>
                <div class="ph">
                    <input class="form-control" name="email" type="email" placeholder="请输入账号">
                </div>
                <div class="ph">
                    <input class="form-control" name="password" type="password" placeholder="请输入密码">
                </div>
            </div>
            <button type="submit" class="ce apn ame fr f14">登&nbsp;录</button>
            <button type="button" class="ce apn ame fr f14" style="margin-right:5px;" onclick="location.href='/signup';">注&nbsp;册</button>
        </div>
    </form>
@endsection