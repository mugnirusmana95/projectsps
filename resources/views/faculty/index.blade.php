@extends('index')

@section('title')
  Fakultas
@endsection

@section('content')
<section class="content-header">
  <h1>
    Fakultas
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Fakultas</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        @if(Session::has('success'))
        <div class="box-header">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{Session::get('success')}}
          </div>
        </div>
        @elseif(Session::has('error'))
        <div class="box-header">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-close"></i> Error!</h4>
            {{Session::get('error')}}
          </div>
        </div>
        @endif
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th>ID Fakultas</th>
                  <th>Nama Fakultas</th>
                  <th>Kode PT</th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($faculty as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$key->fak_id}}</td>
                  <td>{{$key->nama_fakultas}}</td>
                  <td><center>{{$key->kode_pt}}</center></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
