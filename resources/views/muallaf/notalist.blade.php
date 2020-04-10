@extends('voyager::master')

@section('page_title', __('voyager::generic.menu_builder'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i> Nota : [{{$muallaf->no_siri}}] {{$muallaf->nama_asal}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
<h4>Tambah Nota Baru </h4>

<form  class="clearfix" method="post">
    @csrf

  <div class="form-group" action="{{route('savenote', ['id' => $muallaf->id])}}" method="post">
    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="5"></textarea>
  </div>
  <button type="submit" class="btn btn-primary float-right">Simpan</button>

</form>

<hr>
<h4>Nota Terdahulu</h4>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Tarikh</th>
            <th>Pegawai</th>
            <th>Kandungan</th>
        </tr>
    </thead>
    <tbody>
@if ($notes)
    @foreach ($notes as $note)
       <tr>
           <td>{{$note->created_at}}</td>
           <td>{{$note->user->name}}</td>
           <td>{{$note->content}}</td>
       </tr>
    @endforeach
@else
    <p>no data</p>
@endif
    </tbody>    
</table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('javascript')