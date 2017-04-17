@extends('layouts.admin.application', ['menu' => 'applications'] )

@section('metadata')
@stop

@section('styles')
    <style>
        table tr td:nth-child(4) img {
            max-width: 100px;
        }
    </style>
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Applications
@stop

@section('breadcrumb')
<li class="active">Applications</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\ApplicationController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('name', trans('admin.pages.applications.columns.name')) !!}</th>
                <th>{!! \PaginationHelper::sort('version', trans('admin.pages.applications.columns.bundle_id')) !!}</th>
                <th>{!! \PaginationHelper::sort('icon', trans('admin.pages.applications.columns.icon')) !!}</th>
                <th>{!! \PaginationHelper::sort('ios_url', trans('admin.pages.applications.columns.ios_url')) !!}</th>
                <th>{!! \PaginationHelper::sort('android_url', trans('admin.pages.applications.columns.android_url')) !!}</th>
                <th>{!! \PaginationHelper::sort('ads_type', trans('admin.pages.applications.columns.total_device')) !!}</th>
                <th>{!! \PaginationHelper::sort('ads_type', trans('admin.pages.applications.columns.ads_type')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $applications as $application )
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->bundle_id }}</td>
                    <td><img src="{{ $application->icon }}" alt=""></td>
                    <td>{{ $application->ios_url }}</td>
                    <td>{{ $application->android_url }}</td>
                    <td>{{ count($application->devices) }}</td>
                    <td>{{ $application->ads_type }}</td>

                    <td>
                        <a href="{!! action('Admin\ApplicationController@show', $application->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\ApplicationController@destroy', $application->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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