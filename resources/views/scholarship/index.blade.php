@extends('index')

@section('title')
  Beasiswa (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Beasiswa (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Beasiswa (SPK)</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/beasiswa/tambah" class="btn btn-sm btn-info">Tambah Beasiswa (SPK)</a>
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
                  <th><center>No SPK</center></th>
                  <th width="10%"><center>Tahun SPK</center></th>
                  <th width="15%"><center>Sumber Beasiswa</center></th>
                  <th width="15%"><center>Jenis Beasiswa</center></th>
                  <th width="20%"><center>Total Beasiswa</center></th>
                  <th width="22%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($scholarship as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->spk}}</center></td>
                  <td><center>{{$key->year}}</center></td>
                  <td><center>{{$key->source}}</center></td>
                  <td><center>{{$key->type}}</center></td>
                  <td align="right">Rp @if ($key->value == null){{'0'}}@else{{number_format($key->value,0,'.','.')}}@endif,-</td>
                  <td>
                    <a href="/beasiswa/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data {{$key->spk}}" data-placement="left"><span class="fa fa-eye"></span></a>
                    <a href="/beasiswa/termin/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Tambah Termin {{$key->spk}}" data-placement="left"><span class="fa fa-plus"></span></a>
                    <a href="/beasiswa/download/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download Beasiswa (SPK) {{$key->spk}}" data-placement="left"><span class="fa fa-file-excel-o"></span></a>
                    @if($key->termin == 0 )
                    <a href="/beasiswa/ubah/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data {{$key->spk}}" data-placement="left"><span class="fa fa-edit"></span></a>
                    <a href="/beasiswa/mahasiswa/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Tambah Penerima Beasiswa (SPK) {{$key->spk}}" data-placement="left"><span class="fa fa-plus"></span></a>
                    <a href="/beasiswa/hapus/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Beasiswa (SPK) {{$key->spk}}" data-placement="left"><span class="fa fa-trash"></span></a>
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
