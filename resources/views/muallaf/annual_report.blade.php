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

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th rowspan="2">&nbsp;</th>
            @foreach ($kaum as $km)
            <th colspan="2">{!! str_replace(' ', '<br>', $km->name ) !!}</th>
            @endforeach
            <th colspan="2">JUMLAH</th>
            <th rowspan="2">JUMLAH<br>BESAR</th>
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
    @foreach ($year_mon as $k => $v)
       <tr>
           <td>{{$v}}</td>
            @foreach ($kaum as $kk)
           <td>{{$data[ $year.'-'. str_pad($k+1, 2, '0', STR_PAD_LEFT) ][$kk->name]['L']}}</td>
           <td>{{$data[ $year.'-'. str_pad($k+1, 2, '0', STR_PAD_LEFT) ][$kk->name]['P']}}</td> 
            @endforeach
           <td>{{$data[ $year.'-'. str_pad($k+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['L']}}</td>
           <td>{{$data[ $year.'-'. str_pad($k+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['P']}}</td> 
           <td>{{$data[ $year.'-'. str_pad($k+1, 2, '0', STR_PAD_LEFT) ]['JUMLAH']['ALL']}}</td> 
       </tr>
    @endforeach
    </tbody>   
    <thead>
        <tr>
            <th rowspan="2">JUMLAH</th>
            @foreach ($kaum as $k => $km)
           <th>{{$data['JUMLAH'][$km->name]['L']}}</th>
           <th>{{$data['JUMLAH'][$km->name]['P']}}</th> 
            @endforeach
           <th>{{$data['JUMLAH']['JUMLAH']['L']}}</th>
           <th>{{$data['JUMLAH']['JUMLAH']['P']}}</th> 
           <th>{{$data['JUMLAH']['JUMLAH']['ALL']}}</th> 
        </tr>
        <tr>
            @foreach ($kaum as $k => $km)
           <th colspan="2">{{$data['JUMLAH'][$km->name]['ALL']}}</th>
            @endforeach
           <th colspan="2">{{$data['JUMLAH']['JUMLAH']['ALL']}}</th>
           <th>{{$data['JUMLAH']['JUMLAH']['ALL']}}</th> 
        </tr>
    </thead>
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('javascript')