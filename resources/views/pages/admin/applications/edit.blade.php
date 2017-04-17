@extends('layouts.admin.application', ['menu' => 'applications'] )

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
    Applications
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\ApplicationController@index') !!}"><i class="fa fa-files-o"></i> Applications</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $application->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\ApplicationController@store') !!} @else {!! action('Admin\ApplicationController@update', [$application->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\ApplicationController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name">@lang('admin.pages.applications.columns.name')</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') ? old('name') : $application->name }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('version')) has-error @endif">
                            <label for="version">@lang('admin.pages.applications.columns.version')</label>
                            <input type="text" class="form-control" id="version" name="version" required value="{{ old('version') ? old('version') : $application->version }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('bundle_id')) has-error @endif">
                            <label for="bundle_id">@lang('admin.pages.applications.columns.bundle_id')</label>
                            <input type="text" class="form-control" id="bundle_id" name="bundle_id" required value="{{ old('bundle_id') ? old('bundle_id') : $application->bundle_id }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('ads_type')) has-error @endif">
                            <label for="ads_type">@lang('admin.pages.applications.columns.ads_type')</label>
                            <select class="form-control" name="ads_type" id="ads_type" required>
                                <option @if( (old('ads_type') && old('ads_type') == \App\Models\Application::ADS_TYPE_ALL) || ( $application->ads_type === \App\Models\Application::ADS_TYPE_ALL) ) selected @endif  value="{{\App\Models\Application::ADS_TYPE_ALL}}">All</option>
                                <option @if( (old('ads_type') && old('ads_type') == \App\Models\Advertisement::ADS_TYPE_NORMAL) || ( $application->ads_type === \App\Models\Advertisement::ADS_TYPE_NORMAL) ) selected @endif  value="{{\App\Models\Advertisement::ADS_TYPE_NORMAL}}">Normal</option>
                                <option @if( (old('ads_type') && old('ads_type') == \App\Models\Advertisement::ADS_TYPE_VIDEO) || ( $application->ads_type === \App\Models\Advertisement::ADS_TYPE_VIDEO) ) selected @endif  value="{{\App\Models\Advertisement::ADS_TYPE_VIDEO}}">Video</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('icon')) has-error @endif">
                            <label for="icon">@lang('admin.pages.applications.columns.icon')</label>
                            <input type="text" class="form-control" id="icon" name="icon" required value="{{ old('icon') ? old('icon') : $application->icon }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('ios_url')) has-error @endif">
                            <label for="ios_url">@lang('admin.pages.applications.columns.ios_url')</label>
                            <input type="text" class="form-control" id="ios_url" name="ios_url" required value="{{ old('ios_url') ? old('ios_url') : $application->ios_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('android_url')) has-error @endif">
                            <label for="android_url">@lang('admin.pages.applications.columns.android_url')</label>
                            <input type="text" class="form-control" id="android_url" name="android_url" required value="{{ old('android_url') ? old('android_url') : $application->android_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('introduction')) has-error @endif">
                            <label for="introduction">@lang('admin.pages.applications.columns.introduction')</label>
                            <textarea name="introduction" class="form-control" rows="5" required placeholder="@lang('admin.pages.applications.columns.introduction')">{{ old('introduction') ? old('introduction') : $application->introduction }}</textarea>
                        </div>
                    </div>
                </div>

                @if( !$isNew )
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Message
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">@lang('admin.pages.messages.columns.title')</label>
                                            <input type="text" class="form-control" id="message_title" name="message[title]" required value="{{ old('message[title]') ? old('message[title]') : !empty($application->present()->message()) ? $application->present()->message()->title : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group @if ($errors->has('ok_title')) has-error @endif">
                                            <label for="ok_title">@lang('admin.pages.messages.columns.ok_title')</label>
                                            <input type="text" class="form-control" id="message_ok_title" name="message[ok_title]" required value="{{ old('ok_title') ? old('ok_title') : !empty($application->present()->message()) ? $application->present()->message()->ok_title: '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                                            <label for="image_url">@lang('admin.pages.messages.columns.image_url')</label>
                                            <input type="text" class="form-control" id="message_image_url" name="message[image_url]" required value="{{ old('message[image_url]') ? old('message[image_url]') : !empty($application->present()->message()) ? $application->present()->message()->image_url : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('url')) has-error @endif">
                                            <label for="url">@lang('admin.pages.messages.columns.url')</label>
                                            <input type="text" class="form-control" id="message_url" name="message[url]" required value="{{ old('message[url]') ? old('message[url]') : !empty($application->present()->message()) ? $application->present()->message()->url : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('message')) has-error @endif">
                                            <label for="message">@lang('admin.pages.messages.columns.message')</label>
                                            <textarea name="message[message]" required class="form-control" rows="5" placeholder="@lang('admin.pages.messages.columns.message')">{{ old('message[message]') ? old('message[message]') : !empty($application->present()->message()) ? $application->present()->message()->message : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
