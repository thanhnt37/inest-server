@extends('layouts.admin.application', ['menu' => 'messages'] )

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
    Messages
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\MessageController@index') !!}"><i class="fa fa-files-o"></i> Messages</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $message->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\MessageController@store') !!} @else {!! action('Admin\MessageController@update', [$message->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\MessageController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label for="title">@lang('admin.pages.messages.columns.title')</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                   value="{{ old('title') ? old('title') : $message->title }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('ok_title')) has-error @endif">
                            <label for="ok_title">@lang('admin.pages.messages.columns.ok_title')</label>
                            <input type="text" class="form-control" id="ok_title" name="ok_title" required
                                   value="{{ old('ok_title') ? old('ok_title') : $message->ok_title }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('image_url')) has-error @endif">
                            <label for="image_url">@lang('admin.pages.messages.columns.image_url')</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" required
                                   value="{{ old('image_url') ? old('image_url') : $message->image_url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('url')) has-error @endif">
                            <label for="url">@lang('admin.pages.messages.columns.url')</label>
                            <input type="text" class="form-control" id="url" name="url" required
                                   value="{{ old('url') ? old('url') : $message->url }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('message')) has-error @endif">
                            <label for="message">@lang('admin.pages.messages.columns.message')</label>
                            <textarea name="message" class="form-control" rows="5" required
                                      placeholder="@lang('admin.pages.messages.columns.message')">{{ old('message') ? old('message') : $message->message }}</textarea>
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
