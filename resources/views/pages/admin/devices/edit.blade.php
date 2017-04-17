@extends('layouts.admin.application', ['menu' => 'devices'] )

@section('metadata')
@stop

@section('styles')
    <link rel="stylesheet" href="{!! \URLHelper::asset('libs/datetimepicker/css/bootstrap-datetimepicker.min.css', 'admin') !!}">
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss', 'defaultDate': new Date()});

        $(document).ready(function () {
            
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    Devices
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\DeviceController@index') !!}"><i class="fa fa-files-o"></i> Devices</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $device->id }}</li>
    @endif
@stop

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="@if($isNew) {!! action('Admin\DeviceController@store') !!} @else {!! action('Admin\DeviceController@update', [$device->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\DeviceController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('device_id')) has-error @endif">
                            <label for="device_id">@lang('admin.pages.devices.columns.device_id')</label>
                            <input type="text" class="form-control" id="device_id" name="device_id" required value="{{ old('device_id') ? old('device_id') : $device->device_id }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name">@lang('admin.pages.devices.columns.name')</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') ? old('name') : $device->name }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('model')) has-error @endif">
                            <label for="model">@lang('admin.pages.devices.columns.model')</label>
                            <input type="text" class="form-control" id="model" name="model" required value="{{ old('model') ? old('model') : $device->model }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('platform')) has-error @endif">
                            <label for="platform">@lang('admin.pages.devices.columns.platform')</label>
                            <input type="text" class="form-control" id="platform" name="platform" required value="{{ old('platform') ? old('platform') : $device->platform }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('os_version')) has-error @endif">
                            <label for="os_version">@lang('admin.pages.devices.columns.os_version')</label>
                            <input type="text" class="form-control" id="os_version" name="os_version" required value="{{ old('os_version') ? old('os_version') : $device->os_version }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('mode_player')) has-error @endif">
                            <label for="mode_player">@lang('admin.pages.devices.columns.mode_player')</label>
                            <select class="form-control" name="mode_player" id="mode_player" required>
                                <option @if( (old('mode_player') && old('mode_player') == \App\Models\Device::TYPE_MODE_PLAYER_XCD) || ( $device->mode_player === App\Models\Device::TYPE_MODE_PLAYER_XCD) ) selected @endif  value="{{App\Models\Device::TYPE_MODE_PLAYER_XCD}}">{{App\Models\Device::TYPE_MODE_PLAYER_XCD}}</option>
                                <option @if( (old('mode_player') && old('mode_player') == \App\Models\Device::TYPE_MODE_PLAYER_YT) || ( $device->mode_player === App\Models\Device::TYPE_MODE_PLAYER_YT) ) selected @endif  value="{{App\Models\Device::TYPE_MODE_PLAYER_YT}}">{{App\Models\Device::TYPE_MODE_PLAYER_YT}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lbh">@lang('admin.pages.devices.columns.lbh')</label>
                            <div class="switch">
                                <input id="lbh" name="lbh" value="1" @if( $device->lbh) checked
                                       @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
                                <label for="lbh"></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bg">@lang('admin.pages.devices.columns.bg')</label>
                            <div class="switch">
                                <input id="bg" name="bg" value="1" @if( $device->bg) checked
                                       @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
                                <label for="bg"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('ads_name')) has-error @endif">
                            <label for="ads_name">@lang('admin.pages.devices.columns.ads_name')</label>
                            <input type="text" class="form-control" id="ads_name" name="ads_name"
                                   value="{{ old('ads_name') ? old('ads_name') : $device->ads_name }}">
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
