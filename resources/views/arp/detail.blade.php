@extends('index')

@include('time')

@section('title')
  Detail Beasiswa BPP Telah Di ITB (SP2D)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Detail Beasiswa BPP Telah Di ITB (SP2D)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/pembayaran"> Beasiswa BPP Telah Di ITB (SP2D)</a></li>
    <li class="active"> Detail Beasiswa BPP Telah Di ITB (SP2D)</li>
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
      @if($arp->id_ap == 0)
      <a href="/pembayaran/ubah/{{$id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data Tagihan {{$arp->no_payment}}" data-placement='left'><span class="fa fa-edit"></span></a>
      <a href="/pembayaran/hapus/{{$id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Tagihan {{$arp->no_payment}}" data-placement="left"><span class="fa fa-trash"></span></a>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>BPP Telah Di ITB (SP2D)</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No Pembayaran</td>
              <td width="1%">:</td>
              <td>{{$arp->no_payment}}</td>
            </tr>
            <tr>
              <td width="25%">No Referensi SP2D</td>
              <td width="1%">:</td>
              <td>{{$arp->ref_sp2d}}</td>
            </tr>
            <tr>
              <td width="25%">Tanggal Diterima</td>
              <td width="1%">:</td>
              <td>{{strftime('%d %B %Y',strtotime($arp->date_sp2d))}}</td>
            </tr>
            <tr>
              <td width="25%">Total BPP</td>
              <td width="1%">:</td>
              <td>Rp {{number_format($arp->bpp,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td width="25%">Total Pengelolaan</td>
              <td width="1%">:</td>
              <td>Rp {{number_format($arp->pengelolaan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td width="25%">Total Tagihan</td>
              <td width="1%">:</td>
              <td>Rp {{number_format($arp->tagihan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>No Invoice</td>
              <td>:</td>
              <td>{{$arp->invoice}}</td>
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
              <td>{{$arp->spk}}</td>
            </tr>
            <tr>
              <td>Tahun SPK</td>
              <td>:</td>
              <td>{{$arp->year}}</td>
            </tr>
            <tr>
              <td>Sumber Beasiswa</td>
              <td>:</td>
              <td>{{$arp->source}}</td>
            </tr>
            <tr>
              <td>Jenis Beasiswa</td>
              <td>:</td>
              <td>{{$arp->type}}</td>
            </tr>
            <tr>
              <td>Total Beasiswa</td>
              <td>:</td>
              <td>Rp {{number_format($arp->value,0,'.','.')}},-</td>
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
          <h3>Tagihan</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No Invoice</td>
              <td width="1%">:</td>
              <td>{{$arp->invoice}}</td>
            </tr>
            <tr>
              <td>Termin</td>
              <td>:</td>
              <td>{{$arp->termin}} ({{$arp->source}} {{$arp->year}})</td>
            </tr>
            <tr>
              <td>Tanggal Tagihan</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($arp->ar_date))}}</td>
            </tr>
            <tr>
              <td>Jatuh Tempo</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($arp->ar_date_end))}}</td>
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
              $no=1;
            @endphp
            <tbody>
              @foreach ($arp_detail as $key)
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
                    <a href="/master/mahasiswa/lihat/{{crypt::encrypt($key->nim)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data"><span class="fa fa-eye"></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection
