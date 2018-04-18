@extends('index')

@include('time')

@section('title')
  Detail Beasiswa BPP Dibayar Ke ITB
@endsection

@section('content')
<section class="content-header">
  <h1>
    Detail Beasiswa BPP Dibayar Ke ITB
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/penagihan"> Beasiswa Beasiswa BPP Dibayar Ke ITB</a></li>
    <li class="active"> Detail Beasiswa BPP Dibayar Ke ITB</li>
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
      <a href="/penagihan/ubah/{{$id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Ubah Data Tagihan {{$ap->no_pay}}" data-placement='left'><span class="fa fa-edit"></span></a>
      <a href="/penagihan/hapus/{{$id}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Tagihan {{$ap->no_pay}}" data-placement="left"><span class="fa fa-trash"></span></a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3>BPP Dibayar Ke ITB</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No BPP Dibayar Ke ITB</td>
              <td width="1%">:</td>
              <td>{{$ap->no_pay}}</td>
            </tr>
            <tr>
              <td>Tanggal Dibayar</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ap->date_payable))}}</td>
            </tr>
            <tr>
              <td>Total BPP</td>
              <td>:</td>
              <td>Rp {{number_format($ap->bpp,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Pengelolaan</td>
              <td>:</td>
              <td>Rp {{number_format($ap->pengelolaan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Tagihan</td>
              <td>:</td>
              <td>Rp {{number_format($ap->tagihan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Setoran Ke ITB</td>
              <td>:</td>
              <td>Rp {{number_format($ap->bpp,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>No BPP Telah Di ITB (SP2D)</td>
              <td>:</td>
              <td>{{$ap->arp->no_payment}}</td>
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
              <td>{{$ap->arp->ar->scholarship->spk}}</td>
            </tr>
            <tr>
              <td>Tahun SPK</td>
              <td>:</td>
              <td>{{$ap->arp->ar->scholarship->year}}</td>
            </tr>
            <tr>
              <td>Sumber Beasiswa</td>
              <td>:</td>
              <td>{{$ap->arp->ar->scholarship->source}}</td>
            </tr>
            <tr>
              <td>Jenis Beasiswa</td>
              <td>:</td>
              <td>{{$ap->arp->ar->scholarship->type}}</td>
            </tr>
            <tr>
              <td>Total Beasiswa</td>
              <td>:</td>
              <td>Rp {{number_format($ap->arp->ar->scholarship->value,0,'.','.')}},-</td>
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
              <td>{{$ap->arp->ar->invoice}}</td>
            </tr>
            <tr>
              <td>Termin</td>
              <td>:</td>
              <td>{{$ap->termin}} ({{$ap->arp->ar->scholarship->source}} {{$ap->arp->ar->scholarship->year}})</td>
            </tr>
            <tr>
              <td>Total Beasiswa</td>
              <td>:</td>
              <td>Rp {{number_format($ap->arp->ar->bpp,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Pengelolaan</td>
              <td>:</td>
              <td>Rp {{number_format($ap->arp->ar->pengelolaan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Total Tagihan</td>
              <td>:</td>
              <td>Rp {{number_format($ap->arp->ar->tagihan,0,'.','.')}},-</td>
            </tr>
            <tr>
              <td>Tanggal Tagihan</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ap->arp->ar->date))}}</td>
            </tr>
            <tr>
              <td>Jatuh Tempo</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ap->arp->ar->date_end))}}</td>
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
          <h3>BPP Telah Ke ITB (SP2D)</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="25%">No Pembayaran</td>
              <td width="1%">:</td>
              <td>{{$ap->arp->no_payment}}</td>
            </tr>
            <tr>
              <td>Tanggal Pembayaran</td>
              <td>:</td>
              <td>{{strftime('%d %B %Y',strtotime($ap->arp->date_sp2d))}}</td>
            </tr>
            <tr>
              <td>No Referensi SP2D</td>
              <td>:</td>
              <td>{{$ap->arp->ref_sp2d}}</td>
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
          <h3> Daftar Pemegang Beasiswa</h3>
        </div>
        <div class="box-body">
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
              @foreach ($colleger as $key)
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
                  <td align='right'>Rp @if($key->biaya_penelitian == null || $key->biaya_penelitian ==0){{'0'}}@else {{number_format($key->biaya_penelitian,0,'.','.')}}@endif,-</td>
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
