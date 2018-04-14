@extends('index')

@section('title')
  Beasiswa BPP Dibayar Ke ITB
@endsection

@section('content')
<section class="content-header">
  <h1>
    Beasiswa BPP Dibayar Ke ITB
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Beasiswa BPP Dibayar Ke ITB</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/penagihan/tambah" class="btn btn-sm btn-info">Tambah Beasiswa BPP Dibayar Ke ITB</a>
    </div>
  </div>
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
                  <th><center>BPP Dibayar Ke ITB</center></th>
                  <th width="30%"><center>BPP Telah Di ITB (SP2D)</center></th>
                  <th width="20%"><center>Tanggal Dibayar</center></th>
                  <th width="13%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($ap as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->no_pay}}</center></td>
                  <td><center>{{$key->no_payment}}</center></td>
                  <td><center>{{$key->date}}</center></td>
                  <td>
                      <a href="/penagihan/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data {{$key->no_pay}}" data-placement="left"><span class="fa fa-eye"></span></a>
                      <a href="/penagihan/ubah/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data {{$key->no_pay}}" data-placement="left"><span class="fa fa-edit"></span></a>
                      <a href="/penagihan/hapus/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data {{$key->no_pay}}" data-placement="left"><span class="fa fa-trash"></span></a>
                  </td>
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
