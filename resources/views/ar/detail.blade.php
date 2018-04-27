@extends('index')

@include('time')

@section('title')
  Detail Tagihan
@endsection

@section('content')
<section class="content-header">
  <h1>
    Detail Tagihan
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/tagihan"> Tagihan Beasiswa</a></li>
    <li class="active"> Detail Tagihan</li>
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
    <div class="col-md-12" style="margin-bottom:5px">
      <a href="/tagihan/download/{{$id}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download Tagihan {{$ar->invoice}}" data-placement="left"><span class="fa fa-file-excel-o"></span></a>
      <a href="/tagihan/invoice/cetak/{{$id}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Cetak Tagihan {{$ar->invoice}}" data-placement="left"><span class="fa fa-print"></span></a>
      @if($ar->id_ar == 0)
      <a href="/tagihan/mahasiswa/{{$id}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Tambah Penerima Beasiswa {{$ar->invoice}}" data-placement="left"><span class="fa fa-plus"></span></a>
      <a href="/tagihan/ubah/{{$id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data Tagihan {{$ar->invoice}}" data-placement='left'><span class="fa fa-edit"></span></a>
      <a href="/tagihan/hapus/{{$id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Tagihan {{$ar->invoice}}" data-placement="left"><span class="fa fa-trash"></span></a>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>
            Tagihan
          </h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No Invoice</td>
              <td width="1%">:</td>
              <td>{{$ar->invoice}}</td>
            </tr>
            <tr>
              <td>Termin</td>
              <td>:</td>
              <td>{{$ar->termin}} ({{$ar->source}} {{$ar->year}})</td>
            </tr>
            <tr>
              <td>Total BPP</td>
              <td>:</td>
              <td>Rp {{number_format($total->bpp,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Pengelolaan</td>
              <td>:</td>
              <td>Rp {{number_format($total->pengelolaan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Tagihan</td>
              <td>:</td>
              <td>Rp {{number_format($total->total,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Tanggal Tagihan</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ar->date))}}</td>
            </tr>
            <tr>
              <td>Jatuh Tempo</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ar->date_end))}}</td>
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
          <h3>Beasiswa</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No SPK</td>
              <td width="1%">:</td>
              <td>{{$ar->spk}}</td>
            </tr>
            <tr>
              <td>Tahun SPK</td>
              <td>:</td>
              <td>{{$ar->year}}</td>
            </tr>
            <tr>
              <td>Sumber Beasiswa</td>
              <td>:</td>
              <td>{{$ar->source}}</td>
            </tr>
            <tr>
              <td>Jenis Beasiswa</td>
              <td>:</td>
              <td>{{$ar->type}}</td>
            </tr>
            <tr>
              <td>Total Beasiswa</td>
              <td>:</td>
              <td>Rp {{number_format($ar->value,0,'.','.')}},-</td>
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
          <h3> Daftar Penerima Beasiswa</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th rowspan="2" width="1%"><center>No</center></th>
                <th rowspan="2" width='7%'>Mahasiswa</th>
                <th colspan="3"><center>Masa Beasiswa</center></th>
                <th rowspan="2"><center>Semester Penagihan</center></th>
                <th rowspan="2" width="1%"><center>Jml. SKS</center></th>
                <th rowspan="2" width="15%"><center>BPP</center></th>
                <th rowspan="2" width="15%"><center>Pengelolaan</center></th>
                <th rowspan="2" width="15%"><center>Biaya Hidup</center></th>
                <th rowspan="2" width="15%"><center>Biaya Buku</center></th>
                <th rowspan="2" width="15%"><center>Biaya Penelitian</center></th>
                <th rowspan="2" width="1%"><center>Aksi</center></th>
              </tr>
              <tr>
                <th><center>Sem. Awal Beasiswa</center></th>
                <th><center>Sem. Akhir Beasiswa</center></th>
                <th><center>Jml. Sem.</center></th>
              </tr>
            </thead>
            @php
              $no = 1;
            @endphp
            <tbody>
              @foreach ($ard as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td>{{$key->nim_colleger}} - {{$key->colleger->nama_lengkap}}</td>
                  <td><center>@if($key->chapter1 == 1) Gj @elseif($key->chapter1 == 2) Gn @else @endif / {{$key->year1}}</center></td>
                  <td><center>@if($key->chapter2 == 1) Gj @elseif($key->chapter2 == 2) Gn @else @endif / {{$key->year2}}</center></td>
                  <td><center>{{$key->total_chapter}}</center></td>
                  <td><center>@if($key->chapter3 == 1) Gj @elseif($key->chapter3 == 2) Gn @else @endif / {{$key->year3}}</center></td>
                  <td><center>{{$key->total_sks}}</center></td>
                  <td align="right">Rp @if ($key->bpp == null || $key->bpp==0){{'0'}}@else{{number_format($key->bpp,0,'.','.')}}@endif,-</td>
                  <td align='right'>Rp @if ($key->pengelolaan == null || $key->pengelolaan==0){{'0'}}@else{{number_format($key->pengelolaan,0,'.','.')}}@endif,-</center></td>
                  <td align='right'>Rp @if ($key->biaya_hidup == null || $key->biaya_hidup==0){{'0'}}@else{{number_format($key->biaya_hidup,0,'.','.')}}@endif,-</center></td>
                  <td align='right'>Rp @if ($key->biaya_buku == null || $key->biaya_buku==0){{'0'}}@else{{number_format($key->biaya_buku,0,'.','.')}}@endif,-</center></td>
                  <td align='right'>Rp @if ($key->biaya_penelitian == null || $key->biaya_penelitian==0){{'0'}}@else{{number_format($key->biaya_penelitian,0,'.','.')}}@endif,-</center></td>
                  <td>
                    <a href="/tagihan/mahasiswa/ubah/{{\crypt::encrypt($key->id)}}" class="btn btn-sm btn-block btn-warning"><span class="fa fa-edit"></span></a>
                    <a href="/tagihan/mahasiswa/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-block btn-danger"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          </div>
        </div>
        <div class="box-footer">
          Catatan :&nbsp;&nbsp;1. Gj=Ganjil;&nbsp;&nbsp;2. Gn=Genap;&nbsp;&nbsp;3. Jml=Jumlah;&nbsp;&nbsp;4. Sem=Semester;&nbsp;&nbsp;
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
