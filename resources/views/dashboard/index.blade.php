@extends('dashboard.dashboard')
@section('header')
<style>
    .w-100p{
        width: 100%;
    }
    .l-label {
        font-weight: normal;
    }
    .w-30p{
        width:29%;
    }
    .w-33p{
        width:32%;
    }
    .w-70p{
        width:69%;
    }
    .w-50p{
        width:49%;
    }
    .d-inline {
        display:inline;;
    }
    .b-action {
        float:right;
        padding:0;!important;
        width:80px;
    }
    .w-50px{
        width:50px;
        margin-right:5px;
    }
</style>
@endsection
@section('body')
    <div class="hc aps">
        <div class="apa">
            <div class="apb">
                <h6 class="apd">Dashboards</h6>
                <h2 class="apc">{{ app('translator')->trans('language.text.dashboard') }} - {{ $user->name }}</h2>
            </div>
        </div>

        <hr class="aky">

        <div class="fu" ng-controller="ChannelListController">
            {{--<input type="file" style="display:none;" nv-file-select uploader="Uploader" id="fileUploader"/>--}}
            <div class="gr ali">
                <div class="by">
                    <h4 class="ty">
                        {{ app('translator')->trans('language.text.my_channels') }}
                    </h4>
                    <div class="ph" href="#" ng-repeat="p in programs">
                        <label class="l-label" ng-click="editName($index)" ng-show="p.id > 0 && !p.edit" style="margin-bottom:0;">[[ p.name ]] ([[ p.channels.length ]] {{ app('translator')->trans('language.text.channel') }})</label>
                        <button class="ce apn b-action" ng-show="p.id > 0 && !p.edit" ng-click="copyUrl($index)">{{ app('translator')->trans('language.text.show_url') }}</button>
                        <button class="ce apn b-action w-50px" ng-show="p.id > 0 && !p.hash && !p.edit" ng-click="share($index,true)">{{ app('translator')->trans('language.text.share') }}</button>
                        <button class="ce apn b-action w-50px" ng-show="p.hash && !p.edit" ng-click="share($index,false)">{{ app('translator')->trans('language.text.not_share') }}</button>
                        <input class="form-control w-100p" ng-model="p.shareUrl" ng-show="p.shareUrl" ng-blur="p.shareUrl = null">
                        <input class="form-control w-100p" ng-model="p.name" ng-enter="keyPress()" placeholder="{{ app('translator')->trans('language.placeholder.type_program_name') }}" ng-show="p.id == 0 || p.edit" ng-blur="cancelProgram()">
                    </div>

                    <div class="ph" ng-show="programs.length < 10">
                        <a href="#" class="ce apn ame w-100p" ng-click="newProgram()">{{ app('translator')->trans('language.text.add_program') }}</a>
                    </div>
                </div>
                {{--<a href="#" class="ce apn ame" ng-show="programs.length == 10">查看全部</a>--}}
            </div>
            <div class="gr ali">
                <div class="by">
                    <h4 class="ty">
                        {{ app('translator')->trans('language.text.channel') }}
                    </h4>
                    <div class="ph" href="#" ng-repeat="channel in channels" ng-click="editChannel($index)">
                        <span class="dy dh" ng-show="channel.verify">[[ channel.verify ]]</span>
                        <label class="l-label">[[ channel.name ]]</label>
                    </div>

                    <div class="ph" href="#" ng-show="!channels.length && nChannel == null">
                        <label class="l-label">{{ app('translator')->trans('language.message.select_program') }}</label>
                    </div>

                    <div class="ph" ng-show="nChannel != null">
                        <div class="l-label">
                            <input class="form-control w-30p d-inline" ng-model="nChannel.name" ng-enter="channelEnterPress($index,0)" placeholder="{{ app('translator')->trans('language.placeholder.type_channel_name') }}">
                            <input class="form-control w-70p d-inline" ng-model="nChannel.url" ng-enter="channelEnterPress($index,1)" placeholder="{{ app('translator')->trans('language.placeholder.type_channel_url') }}">
                        </div>
                    </div>

                    <div class="ph">
                        <!--<button class="ce apn ame w-33p" ng-show="nChannel == null" onclick="$('#fileUploader').click();">导入频道</button>-->
                        <button class="ce apn ame w-50p" ng-show="nChannel == null" ng-click="addChannel()">{{ app('translator')->trans('language.text.add_channel') }}</button>
                        <button class="ce apn ame w-50p" ng-show="nChannel == null" ng-click="checkChannel()">{{ app('translator')->trans('language.text.validate_channel') }}</button>
                        <button class="ce apn ame w-50p" ng-show="nChannel != null" ng-click="saveChannel()">{{ app('translator')->trans('language.text.save_channel') }}</button>
                        <button class="ce apn ame w-50p" ng-show="nChannel != null" ng-click="removeChannel()">{{ app('translator')->trans('language.text.remove_channel') }}</button>
                    </div>

                </div>
                {{--<a href="#" class="ce apn ame" ng-show="channels.length == 10">查看全部</a>--}}
            </div>
        </div>
    </div>

@endsection