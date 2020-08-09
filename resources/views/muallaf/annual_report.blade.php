@extends('voyager::master')

@section('page_title', __('voyager::generic.menu_builder'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-calendar"></i> PENGISLAMAN {{$year}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
<h4>PERKIM SELANGOR</h4>

<table class="table table-striped">
    <thead>
        <tr>
            <th rowspan="2">&nbsp;</th>
            @foreach ($kaum as $km)
            <th colspan="2">{!! str_replace(' ', '<br>', $km->name ) !!}</th>
            @endforeach
            <th colspan="2">JUMLAH</th>
            <th rowspan="2">JUMLAH BESAR</th>
        </tr>
        <tr>
            @foreach ($kaum as $km)
            <th>L</th>
            <th>P</th>
            @endforeach
            <th>L</th>
            <th>P</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $ym => $dt)
       <tr>
           <td>{{$ym}}</td>
            @foreach ($kaum as $kk)
           <td>{{$data[$ym][$kk->name]['L']}}</td>
           <td>{{$data[$ym][$kk->name]['P']}}</td> 
            @endforeach
           <td>{{$data[$ym]['JUMLAH']['L']}}</td>
           <td>{{$data[$ym]['JUMLAH']['P']}}</td> 
           <td>{{$data[$ym]['JUMLAH']['ALL']}}</td> 
       </tr>
    @endforeach
    </tbody>    
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('javascript')