@extends('layouts.admin.application', ['menu' => 'messages'] )

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
    Messages
@stop

@section('breadcrumb')
    <li class="active">Messages</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\MessageController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('title', trans('admin.pages.messages.columns.title')) !!}</th>
                <th>{!! \PaginationHelper::sort('image_url', trans('admin.pages.messages.columns.image_url')) !!}</th>
                <th>{!! \PaginationHelper::sort('ok_title', trans('admin.pages.messages.columns.ok_title')) !!}</th>
                <th>{!! \PaginationHelper::sort('url', trans('admin.pages.messages.columns.url')) !!}</th>

                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $messages as $message )
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->image_url }}</td>
                    <td>{{ $message->ok_title }}</td>
                    <td>{{ $message->url }}</td>

                    <td>
                        <a href="{!! action('Admin\MessageController@show', $message->id) !!}"
                           class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button"
                           data-delete-url="{!! action('Admin\MessageController@destroy', $message->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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