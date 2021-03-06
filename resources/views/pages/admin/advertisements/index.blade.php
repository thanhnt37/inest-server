@extends('layouts.admin.application', ['menu' => 'advertisements'] )

@section('metadata')
@stop

@section('styles')
    <style>
        table tr td:nth-child(4) img {
            max-width: 200px;
        }
    </style>
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Advertisements
@stop

@section('breadcrumb')
<li class="active">Advertisements</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\AdvertisementController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('type', trans('admin.pages.advertisements.columns.type')) !!}</th>
                <th>{!! \PaginationHelper::sort('name', trans('admin.pages.advertisements.columns.name')) !!}</th>
                <th>{!! \PaginationHelper::sort('icon_url', trans('admin.pages.advertisements.columns.icon_url')) !!}</th>
                <th>{!! \PaginationHelper::sort('url', trans('admin.pages.advertisements.columns.url')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $advertisements as $advertisement )
                <tr>
                    <td>{{ $advertisement->id }}</td>
                    <td>{{ $advertisement->type }}</td>
                    <td>{{ $advertisement->name }}</td>
                    <td><img src="{{$advertisement->icon_url}}" alt=""></td>
                    <td>{{ $advertisement->url }}</td>

                    <td>
                        <a href="{!! action('Admin\AdvertisementController@show', $advertisement->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\AdvertisementController@destroy', $advertisement->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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