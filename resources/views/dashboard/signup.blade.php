@extends('dashboard.template')
@section('content')
    <form action="/signup" method="post">
        <div class="ali center w-300">
            <div class="by">
                <h4 class="ty">
                    {{ app('translator')->trans('language.text.register') }}
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
                        <input class="form-control" name="email" type="email" placeholder="{{ app('translator')->trans('language.placeholder.type_email') }}">
                    </div>
                    <div class="ph">
                        <input class="form-control" name="name" type="text" placeholder="{{ app('translator')->trans('language.placeholder.type_name') }}">
                    </div>
                    <div class="ph">
                        <input class="form-control" name="password" type="password" placeholder="{{ app('translator')->trans('language.placeholder.type_password') }}">
                    </div>
                @endif
            </div>
            @if(!$user)
                <button type="submit" class="ce apn ame fr f14">{{ app('translator')->trans('language.text.register') }}</button>
                <button type="button" class="ce apn ame fr f14" style="margin-right:5px;" onclick="location.href='/login';">{{ app('translator')->trans('language.text.login') }}</button>
            @else
                <button type="button" class="ce apn ame fr f14" onclick="location.href='/login';">{{ app('translator')->trans('language.text.login_now') }}</button>
            @endif
        </div>
    </form>
@endsection