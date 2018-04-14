@extends('index')

@include('time')

@section('title')
  Beasiswa BPP Telah Di ITB
@endsection

@section('content')
<section class="content-header">
  <h1>
    Beasiswa BPP Telah Di ITB (SP2D)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Beasiswa BPP Telah Di ITB</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/pembayaran/tambah" class="btn btn-sm btn-info">Tambah Beasiswa BPP Telah Di ITB</a>
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
                  <th><center>No Pembayaran</center></th>
                  <th width="20%"><center>No Tagihan</center></th>
                  <th width="20%"><center>No Ref. SP2D</center></th>
                  <th width="20%"><center>Tanggal Pembayaran</center></th>
                  <th width="12%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($arp as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->no_payment}}</center></td>
                  <td><center>{{$key->invoice}}</center></td>
                  <td><center>{{$key->ref_sp2d}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date_sp2d))}}</center></td>
                  <td>
                    <a href="/pembayaran/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data {{$key->no_payment}}" data-placement="left"><span class="fa fa-eye"></span></a>
                    @if($key->id_ap == 0)
                    <a href="/pembayaran/ubah/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data {{$key->no_payment}}" data-placement="left"><span class="fa fa-edit"></span></a>
                    <a href="/pembayaran/hapus/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data {{$key->no_payment}}" data-placement="left"><span class="fa fa-trash"></span></a>
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
