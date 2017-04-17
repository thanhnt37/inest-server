@extends('layouts.admin.application', ['menu' => 'advertisements'] )

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
    Advertisements
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AdvertisementController@index') !!}"><i class="fa fa-files-o"></i> Advertisements</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $advertisement->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\AdvertisementController@store') !!} @else {!! action('Admin\AdvertisementController@update', [$advertisement->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\AdvertisementController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name">@lang('admin.pages.advertisements.columns.name')</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') ? old('name') : $advertisement->name }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('type')) has-error @endif">
                            <label for="type">@lang('admin.pages.advertisements.columns.type')</label>
                            <select class="form-control" name="type" id="type" required>
                                <option @if( (old('type') && old('type') == \App\Models\Advertisement::ADS_TYPE_NORMAL) || ( $advertisement->type === \App\Models\Advertisement::ADS_TYPE_NORMAL) ) selected @endif  value="{{\App\Models\Advertisement::ADS_TYPE_NORMAL}}">Normal</option>
                                <option @if( (old('type') && old('type') == \App\Models\Advertisement::ADS_TYPE_VIDEO) || ( $advertisement->type === \App\Models\Advertisement::ADS_TYPE_VIDEO) ) selected @endif  value="{{\App\Models\Advertisement::ADS_TYPE_VIDEO}}">Video</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('icon_url')) has-error @endif">
                            <label for="icon_url">@lang('admin.pages.advertisements.columns.icon_url')</label>
                            <input type="text" class="form-control" id="icon_url" name="icon_url" required
                                   value="{{ old('icon_url') ? old('icon_url') : $advertisement->icon_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('url')) has-error @endif">
                            <label for="url">@lang('admin.pages.advertisements.columns.url')</label>
                            <input type="text" class="form-control" id="url" name="url" required
                                   value="{{ old('url') ? old('url') : $advertisement->url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <label for="description">@lang('admin.pages.advertisements.columns.description')</label>
                            <textarea name="description" class="form-control" rows="5" required
                                      placeholder="@lang('admin.pages.advertisements.columns.description')">{{ old('description') ? old('description') : $advertisement->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                            <label for="image_url">@lang('admin.pages.advertisements.columns.image_url')</label>
                            <input type="text" class="form-control" id="image_url" name="image_url"
                                   value="{{ old('image_url') ? old('image_url') : $advertisement->image_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('video_url')) has-error @endif">
                            <label for="video_url">@lang('admin.pages.advertisements.columns.video_url')</label>
                            <input type="text" class="form-control" id="video_url" name="video_url"
                                   value="{{ old('video_url') ? old('video_url') : $advertisement->video_url }}">
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
