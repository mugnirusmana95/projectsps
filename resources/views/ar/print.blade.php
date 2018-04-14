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
    <td>Kuasa Pengguna Anggaran Direktorat Jenderal Sumber Daya Ilmu Pengetahuan, Teknologi, dan Pendidikan Tinggi</td>
  </tr>
  <tr>
    <td>Jumlah uang</td>
    <td>:</td>
    <td><b>Rp. {{number_format($invoice->bpp,0,'.','.')}},-</b></td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td>:</td>
    <td><b>{{terbilang($invoice->bpp)}} rupiah</b></td>
  </tr>
  <tr>
    <td>Untuk Pembayaran</td>
    <td>:</td>
    <td>Penyaluran Bantuan Perpanjangan Studi Program Doktor (S3) bagi Penerima Beasiswa Pendidikan Pascasarjana Dalam Negeri (BPP-DN) Angkatan 2014 Tahun Anggaran 2017, Sesuai dengan Kontrak Nomor 1777.3/D3/PG/2017, Tanggal 19 September 2017</td>
  </tr>
</table>

<br>
<br>

<table>
  <tr>
    <td>
      <hr class="hr">
      <b>Rp. {{number_format($invoice->bpp,0,'.','.')}},-</b>
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
      <b>Prof. Pudji Astuti, MS</b><br>
      <b>NIP 19610401 198601 2 001</b>
    </td>
  </tr>
</table>

<br>
<br>

@endsection
