@extends('index')

@include('time')

@section('title')
  Tagihan Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tagihan Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Tagihan Beasiswa</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/tagihan/tambah" class="btn btn-sm btn-info">Tambah Tagihan Beasiswa</a>
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
                  <th width="1%"><center>No Invoice</center></th>
                  <th><center>No SPK</center></th>
                  <th width="10%"><center>Beasiswa</center></th>
                  <th width="10%"><center>Termin</center></th>
                  <th width="13%"><center>Tanggal Tagihan</center></th>
                  <th width="13%"><center>Jatuh Tempo</center></th>
                  <th width="25%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($ar as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->invoice}}</center></td>
                  <td><center>{{$key->spk}}</center></td>
                  <td>{{$key->source}} - {{$key->year}}</td>
                  <td><center>{{$key->termin}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date))}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date_end))}}</center></td>
                  <td>
                    <a href="/tagihan/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data {{$key->invoice}}" data-placement="left"><span class="fa fa-eye"></span></a>
                    <a href="/tagihan/download/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download Data {{$key->invoice}}" data-placement="left"><span class="fa fa-file-excel-o"></span></a>
                    <a href="/tagihan/invoice/cetak/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Print Data {{$key->invoice}}" data-placement="left"><span class="fa fa-print"></span></a>
                    @if($key->id_ar == 0)
                    <a href="/tagihan/mahasiswa/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Tambah Penerima Beasiswa {{$key->invoice}}" data-placement="left"><span class="fa fa-plus"></span></a>
                    <a href="/tagihan/ubah/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data {{$key->invoice}}" data-placement="left"><span class="fa fa-edit"></span></a>
                    <a href="/tagihan/hapus/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data {{$key->invoice}}" data-placement="left"><span class="fa fa-trash"></span></a>
                    @endif
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
