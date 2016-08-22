@extends('dashboard.template')

@section('content')
    <div class="ali center">
        <div class="by">
            <h4 class="ty">
                频道分享 (<a href="/dashboard/">控制台</a>)
            </h4>
            @foreach($programs as $program)
                <div class="ph">
                    <a href="/t/{{ $program->hash }}">{{ $program->name }}</a> ({{ $program->count }}频道)
                </div>
            @endforeach
        </div>
    </div>
@endsection