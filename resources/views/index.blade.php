@extends('dashboard.template')

@section('content')
    <div class="ali center">
        <div class="by">
            <h4 class="ty">
                {{ app('translator')->trans('language.text.channel_share') }} ( <a href="/dashboard/">{{ app('translator')->trans('language.text.dashboard') }}</a> )
            </h4>
            @foreach($programs as $program)
                <div class="ph">
                    <a href="/t/{{ $program->hash }}">{{ $program->name }}</a> ({{ $program->count }} {{ app('translator')->trans('language.text.channel') }})
                    <label class="fr">{{ $program->user->name }}</label>
                    <a href="/s/{{ $program->hash }}" class="fr">{{ app('translator')->trans('language.text.right_click_copy') }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection