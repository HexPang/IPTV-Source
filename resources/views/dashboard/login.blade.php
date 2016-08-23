@extends('dashboard.template')
@section('content')
    <form action="/dashboard/login" method="post">
        <div class="ali center w-300">
            <div class="by">
                <h4 class="ty">
                    {{ app('translator')->trans('language.text.login') }}
                    @if(isset($msg))
                        <label class="alert-info">{{ $msg }}</label>
                    @endif
                </h4>
                <div class="ph">
                    <input class="form-control" name="email" type="email" placeholder="{{ app('translator')->trans('language.placeholder.type_email') }}">
                </div>
                <div class="ph">
                    <input class="form-control" name="password" type="password" placeholder="{{ app('translator')->trans('language.placeholder.type_password') }}">
                </div>
            </div>
            <button type="submit" class="ce apn ame fr f14">{{ app('translator')->trans('language.text.login') }}</button>
            <button type="button" class="ce apn ame fr f14" style="margin-right:5px;" onclick="location.href='/signup';">{{ app('translator')->trans('language.text.register') }}</button>
        </div>
    </form>
@endsection