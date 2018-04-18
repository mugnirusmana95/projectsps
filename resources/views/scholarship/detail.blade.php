@extends('index')

@section('title')
  Detail Beasiswa (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Detail Beasiswa (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/beasiswa"> Beasiswa (SPK)</a></li>
    <li class="active"> Detail Beasiswa (SPK)</li>
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

@if($total_pemegang->total > $scholarship->value)
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Info!</h4>
        Total Pemegang Beasiswa Melebihi Dari Total Beasiswa
      </div>
    </div>
  </div>
</section>
@elseif($total_pemegang->total < $scholarship->value)
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Info!</h4>
        Total Pemegang Beasiswa Kurang Dari Total Beasiswa
      </div>
    </div>
  </div>
</section>
@endif

@if($total_termin->total > $scholarship->value)
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Info!</h4>
        Total Termin Melebihi Dari Total Beasiswa
      </div>
    </div>
  </div>
</section>
@elseif($total_termin->total < $scholarship->value)
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Info!</h4>
        Total Termin Kurang Dari Total Beasiswa
      </div>
    </div>
  </div>
</section>
@endif

<section class="content">
  <div class="row">
    <div class="col-md-12" style="margin-bottom:5px">
      <a href="/beasiswa/termin/{{$id}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Tambah Termin"><span class="fa fa-plus"></span></a>
      <a href="/beasiswa/download/{{$id}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download Beasiswa (SPK) (Excel)"><span class="fa fa-file-excel-o"></span></a>
      @if($scholarship->termin==0)
      <a href="/beasiswa/ubah/{{$id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data Beasiswa"><span class="fa fa-edit"></span></span></a>
      <a href="/beasiswa/mahasiswa/{{$id}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Tambah Pemegang Beasiswa"><span class="fa fa-plus"></span></a>
      <a href="/beasiswa/hapus/{{$id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data Beasiswa"><span class="fa fa-trash"></span></a>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>Beasiswa</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="15%">No SPK</td>
              <td width="1%">:</td>
              <td>{{$scholarship->spk}}</td>
            </tr>
            <tr>
              <td>Tahun SPK</td>
              <td>:</td>
              <td>{{$scholarship->year}}</td>
            </tr>
            <tr>
              <td>Sumber Beasiswa</td>
              <td>:</td>
              <td>{{$scholarship->source}}</td>
            </tr>
            <tr>
              <td>Jenis Beasiswa</td>
              <td>:</td>
              <td>{{$scholarship->type}}</td>
            </tr>
            <tr>
              <td>Total Beasiswa</td>
              <td>:</td>
              <td>Rp {{number_format($scholarship->value)}},-</td>
            </tr>
          </table>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>Detail Termin</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example2" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th>Nama Termin</th>
                  <th width="17%"><center>Total BPP</center></th>
                  <th width="17%"><center>Total Pengelolaan</center></th>
                  <th width="15%"><center>Tanggal Tagihan</center></th>
                  <th width="15%"><center>Jatuh Tempo</center></th>
                  <th width="10%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no2=1;
              @endphp
              <tbody>
                @foreach ($termin as $key)
                  <tr>
                    <td><center>{{$no2++}}</center></td>
                    <td>{{$key->name}}</td>
                    <td align='right'>Rp @if($key->bpp == null){{'0'}}@else {{number_format($key->bpp,0,'.','.')}} @endif,-</td>
                    <td align='right'>Rp @if($key->pengelolaan == null){{'0'}}@else {{number_format($key->pengelolaan,0,'.','.')}} @endif,-</td>
                    <td><center>{{$key->date}}</center></td>
                    <td><center>{{$key->date_end}}</center></td>
                    <td>
                      @if($key->id_ar==null)
                      <a href="/beasiswa/termin/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data"><span class="fa fa-edit"></span></a>
                      <a href="/beasiswa/termin/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data"><span class="fa fa-trash"></span></a>
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

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>Daftar Pemegang Beasiswa</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th width='10%'>Mahasiswa</th>
                  <th width="1%"><center>Sem. Awal</center></th>
                  <th width="1%"><center>Sem. Akhir</center></th>
                  <th width="1%"><center>Jml. SKS</center></th>
                  <th width="1%"><center>Jml. Sem.</center></th>
                  <th width="15%"><center>BPP</center></th>
                  <th width="15%"><center>Pengelolaan</center></th>
                  <th width="15%"><center>Biaya Hidup</center></th>
                  <th width="15%"><center>Biaya Buku</center></th>
                  <th width="15%"><center>Biaya Penelitian</center></th>
                  <th width="1%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($detail as $key)
                  <tr>
                    <td><center>{{$no++}}</center></td>
                    <td>{{$key->nim_colleger}} - {{$key->colleger->nama_lengkap}}</td>
                    <td><center>@if($key->chapter1 == 1) Ganjil @else Genap @endif / {{$key->year1}}</center></td>
                    <td><center>@if($key->chapter2 == 1) Ganjil @else Genap @endif / {{$key->year2}}</center></td>
                    <td><center>{{$key->total_sks}}</center></td>
                    <td><center>{{$key->total_chapter}}</center></td>
                    <td align="right">Rp @if($key->bpp == null || $key->bpp ==0){{'0'}}@else{{number_format($key->bpp,0,'.','.')}}@endif,-</td>
                    <td align="right">Rp @if($key->pengelolaan == null || $key->pengelolaan ==0){{'0'}}@else{{number_format($key->pengelolaan,0,'.','.')}}@endif,-</td>
                    <td align='right'>Rp @if($key->biaya_hidup == null || $key->biaya_hidup ==0){{'0'}}@else{{number_format($key->biaya_hidup,0,'.','.')}}@endif,-</td>
                    <td align='right'>Rp @if($key->biaya_buku == null || $key->biaya_buku ==0){{'0'}}@else{{number_format($key->biaya_buku,0,'.','.')}}@endif,-</td>
                    <td align='right'>Rp @if($key->biaya_penelitian == null || $key->biaya_penelitian ==0){{'0'}}@else{{number_format($key->biaya_penelitian)}}@endif,-</td>
                    <td>
                      <a href="/master/mahasiswa/lihat/{{crypt::encrypt($key->nim_colleger)}}" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" title="Lihat Data"><span class="fa fa-eye"></span></a>
                      @if($scholarship->termin==0)
                      <a href="/beasiswa/mahasiswa/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning btn-block" data-toggle="tooltip" title="Ubah Data"><span class="fa fa-edit"></span></a>
                      <a href="/beasiswa/mahasiswa/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger btn-block" data-toggle="tooltip" title="Hapus Data"><span class="fa fa-trash"></span></a>
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
