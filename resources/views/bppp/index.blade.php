@extends('index')

@section('title')
  BPP Prodi
@endsection

@section('content')
<section class="content-header">
  <h1>
    BPP Prodi
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> BPP Prodi</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/master/bpp_prodi/tambah" class="btn btn-sm btn-info">Tambah BPP Prodi</a>
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
                  <th>Prodi</th>
                  <th width="25%"><center>Tahun Ajaran</center></th>
                  <th width="25%"><center>BPP</center></th>
                  <th width="8%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($bpp as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$key->prodi}}</td>
                  <td><center>{{$key->year}}</center></td>
                  <td align="right">Rp {{number_format($key->bpp)}}.00,-</td>
                  <td>
                    <a href="/master/bpp_prodi/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data Bpp Prodi"><span class="fa fa-edit"></span></a>
                    <a href="/master/bpp_prodi/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data Bpp Prodi"><span class="fa fa-trash"></span></a>
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
