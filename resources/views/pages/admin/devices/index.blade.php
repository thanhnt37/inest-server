@extends('layouts.admin.application', ['menu' => 'devices'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Devices
@stop

@section('breadcrumb')
<li class="active">Devices</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\DeviceController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
                    </p>
                </h3>
                <br>
                <p style="display: inline-block;">@lang('admin.pages.common.label.search_results', ['count' => $count])</p>
            </div>
            <div class="col-sm-6 wrap-top-pagination">
                <div class="heading-page-pagination">
                    {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], [], $count, 'shared.topPagination') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-body" style=" overflow-x: scroll; ">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">{!! \PaginationHelper::sort('id', 'ID') !!}</th>
                <th>{!! \PaginationHelper::sort('name', trans('admin.pages.devices.columns.device_id')) !!}</th>
                <th>{!! \PaginationHelper::sort('name', trans('admin.pages.devices.columns.name')) !!}</th>
                <th>{!! \PaginationHelper::sort('model', trans('admin.pages.devices.columns.model')) !!}</th>
                <th>{!! \PaginationHelper::sort('platform', trans('admin.pages.devices.columns.platform')) !!}</th>
                <th>{!! \PaginationHelper::sort('os_version', trans('admin.pages.devices.columns.os_version')) !!}</th>
                <th>{!! \PaginationHelper::sort('mode_player', trans('admin.pages.devices.columns.mode_player')) !!}</th>
                <th style="width: 10px">{!! \PaginationHelper::sort('lbh', trans('admin.pages.devices.columns.lbh')) !!}</th>
                <th style="width: 10px">{!! \PaginationHelper::sort('bg', trans('admin.pages.devices.columns.bg')) !!}</th>
                <th>{!! \PaginationHelper::sort('ads_name', trans('admin.pages.devices.columns.ads_name')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $devices as $device )
                <tr>
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->device_id }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->model }}</td>
                    <td>{{ $device->platform }}</td>
                    <td>{{ $device->os_version }}</td>
                    <td>{{ $device->mode_player }}</td>
                    <td>
                        @if( $device->lbh )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        @if( $device->bg )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>{{ $device->ads_name }}</td>

                    <td>
                        <a href="{!! action('Admin\DeviceController@show', $device->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\DeviceController@destroy', $device->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], []) !!}
    </div>
</div>
@stop