@extends('index')

@section('title')
  {{$faculty->name}}
@endsection

@section('content')
<section class="content-header">
  <h1>
    {{$faculty->name}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/fakultas"> Fakultas</a></li>
    <li class="active"> {{$faculty->name}}</li>
  </ol>
</section>

@if(Session::has('success'))
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{Session::get('success')}}
      </div>
    </div>
  </div>
</section>
@endif

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <table id="example1" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th width="1%"><center>No</center></th>
                <th>Program Studi</th>
                <th width="10%"><center>Aksi</center></th>
              </tr>
            </thead>
            @php
              $no=1;
            @endphp
            <tbody>
              @foreach ($study as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$key->name}}</td>
                  <td>
                    <center>
                      <a href="/master/fakultas/program_studi/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data"><span class="fa fa-edit"></span></a>
                      <a href="/master/fakultas/program_studi/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data"><span class="fa fa-trash"></span></a>
                    </center>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <a href="/master/fakultas/ubah/{{$id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data"><span class="fa fa-edit"></span></a>
          <a href="/master/fakultas/program_studi/{{$id}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Tambah Program Studi"><span class="fa fa-plus"></span></a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
