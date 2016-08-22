@extends('dashboard.template')
@section('content')
    <form action="/dashboard/login" method="post">
        <div class="ali center">
            <div class="by">
                <h4 class="ty">
                    直播列表
                </h4>
                @foreach($channels as $c)
                <div class="ph">
                    <a href="{{ $c->url }}">{{ $c->name }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection