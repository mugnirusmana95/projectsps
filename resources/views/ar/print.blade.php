@extends('layouts.paper')

@include('layouts.terbilang')

@section('paper_title')
Invoice_{{$invoice->invoice}}
@endsection

@section('angka')
{{$invoice->bpp}}
@endsection


@section('paper_main')
<center><u><b><h1>K W I T A N S I</h1></b></u></center>

<br>
<br>

<table class="table">
  <tr>
    <td width="20%">Sudah terima dari</td>
    <td width="2%">:</td>
    <td>{{$diterima}}</td>
  </tr>
  <tr>
    <td>Jumlah uang</td>
    <td>:</td>
    <td><b>Rp. {{number_format($total->tagihan,0,'.','.')}},-</b></td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td>:</td>
    <td><b>{{terbilang($total->tagihan)}} rupiah</b></td>
  </tr>
  <tr>
    <td>Untuk Pembayaran</td>
    <td>:</td>
    <td>{{$deskripsi}}</td>
  </tr>
</table>

<br>
<br>

<table>
  <tr>
    <td>
      <hr class="hr">
      <b>Rp. {{number_format($total->tagihan,0,'.','.')}},-</b>
      <hr class="hr">
    </td>
  </tr>
</table>

<br>
<br>

<table class="table">
  <tr>
    <td width="60%"></td>
    <td>
      Mengetahui,<br>
      Dekan Sekolah Pascasarjana<br>
      Institut Teknologi Bandung<br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <b>{{$nama}}</b><br>
      <b>{{$nip}}</b>
    </td>
  </tr>
</table>

<br>
<br>

@endsection
