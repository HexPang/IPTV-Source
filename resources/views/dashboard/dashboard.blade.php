@extends('dashboard.template')

@section('content')
    <div class="ge aom">
        <nav class="aot">
            <div class="aon">
                <button class="amy amz aoo" type="button" data-toggle="collapse" data-target="#nav-toggleable-sm">
                    <span class="ct">Toggle nav</span>
                </button>
                <a class="aop cn" href="index.html">
                    <span class="bv act aoq"></span>
                </a>
            </div>

            <div class="collapse and" id="nav-toggleable-sm">

                <ul class="nav of nav-stacked">
                    <li class="tq">Dashboards</li>
                    <li class="active">
                        <a href="/dashboard/">{{ app('translator')->trans('language.text.dashboard') }}</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="/dashboard/group/">分组管理</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="/dashboard/channel/">我的频道</a>--}}
                    {{--</li>--}}
                    <li>
                        {{--/dashboard/my_follow/--}}
                        <a href="javascript:alert('Comming Soon..');">{{ app('translator')->trans('language.text.my_subscribe') }}</a>
                    </li>
                </ul>
                <hr class="rw aky">
            </div>
        </nav>
    </div>
    @yield('body')
@endsection