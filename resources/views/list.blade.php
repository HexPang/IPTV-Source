@extends('dashboard.template')
@section('content')
    <form action="/dashboard/login" method="post">
        <div class="ali center">
            <div class="by">
                <h4 class="ty">
                    {{ app('translator')->trans('language.text.source_list') }} ( <a href="/">{{ app('translator')->trans('language.text.back') }}</a> )
                </h4>
                @foreach($channels as $c)
                <div class="ph">
                    <a href="{{ $c->url }}" target="_blank">{{ $c->name }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection