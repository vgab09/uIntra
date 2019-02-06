<?php
/** @var \App\Http\Components\ListHelper\ListHelper $listHelper */
/** @var \App\Http\Components\ListHelper\ListFieldHelper $column */
?>

@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$listHelper->getTitle()}}
        </div>
        <div class="card-body card-block">
            <table class="table table-bordered " id="tableList-{{$listHelper->getListName()}}">
                <thead>
                    <tr>
                        @foreach($listHelper->getListItems() as $column)
                            <th class="{{$column->getStyle()}}">{{$column->getTitle()}}</th>
                        @endforeach
                    </tr>
                    <tr class="filter">
                        @foreach($listHelper->getListItems() as $column)
                            <th>{!! $column->getSearchElement() !!}</th>
                        @endforeach
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ mix('/js/datatable.js') }}"></script>
    <script>
        window.LaravelDataTables["tableList-{{$listHelper->getListName()}}"] = $("#tableList-{{$listHelper->getListName()}}")
            .on('stateLoadParams.dt', window.dTstateLoadParams)
            .DataTable(@json($listHelper->getDataTableParameters()));
    </script>
@endpush

@push('stylesheet')
    <link href="{{ mix('/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
@endpush

