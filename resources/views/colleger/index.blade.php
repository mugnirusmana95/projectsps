@extends('index')

@section('title')
  Mahasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Mahasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Mahasiswa</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/master/mahasiswa/tambah" class="btn btn-md btn-info">Tambah Mahasiswa</a>
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
                  <th width="15%"><center>NIM</center></th>
                  <th>Nama</th>
                  <th><center>Program</center></th>
                  <th width="15%"><center>Fakultas</center></th>
                  <th width="20%"><center>Program Studi</center></th>
                  <th width="10%"><center>Status</center></th>
                  {{-- <th width="15%"><center>Aksi</center></th> --}}
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($colleger as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->nim}}</center></td>
                  <td>{{$key->nama_lengkap}}</td>
                  <td><center>{{$key->strata}}</center></td>
                  <td>{{$key->fak_id}}</td>
                  <td>{{$key->prodi_id}}</td>
                  <td><center>{{$key->status}}</center></td>
                  {{-- <td>
                    <center>
                      <a href="/master/mahasiswa/lihat/{{crypt::encrypt($key->nim)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Open Data"><span class="fa fa-eye"></span></a>
                      <a href="/master/mahasiswa/ubah/{{crypt::encrypt($key->nim)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Update Data"><span class="fa fa-edit"></span></a>
                      @if ($key->status == 1)
                      <a href="/master/mahasiswa/nonaktif/{{crypt::encrypt($key->nim)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Non Aktifkan Data"><span class="fa fa-close"></span></a>
                      @else
                      <a href="/master/mahasiswa/aktif/{{crypt::encrypt($key->nim)}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Aktifkan Data"><span class="fa fa-check"></span></a>
                      @endif
                      <a id="delete" href="" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data"><span class="fa fa-close"></span></a>
                    </center> --}}
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

@section('js')
@include('colleger.script')
@endsection
