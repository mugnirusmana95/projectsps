<!DOCTYPE html>
@include('time')

@php
//  dd($beasiswa);
@endphp

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/table.css')}}">
  </head>
  <body>

    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="16"><h1>LAPORAN BEASISWA {{$beasiswa->source}} - {{$beasiswa->year}}@if($beasiswa->termin==null) @else - {{$beasiswa->termin}}@endif</h1></td>
      </tr>
    </table>

    <table class="table1">
      <thead>
        <tr style="background-color:#FFC000">
          <th width="5" rowspan="3" align="center">NO</th>
          <th width="20" rowspan="3" align="center">Sumber Beasiswa</th>
          <th width="15" rowspan="3" align="center">Tahun SPK</th>
          <th width="35" rowspan="3" align="center">No SPK</th>
          <th width="20" rowspan="3" align="center">Jenis Beasiswa</th>
          <th width="15" rowspan="3" align="center">NIM</th>
          <th width="35" rowspan="3" align="center">Nama Mahasiswa</th>
          <th width="25" rowspan="3" align="center">Sem. Masuk (GJ/GN)</th>
          <th width="15" rowspan="3" align="center">Jenjang Studi</th>
          <th width="40" rowspan="3" align="center">Prodi</th>
          <th width="15" rowspan="3" align="center">Fakultas</th>
          <th width="40" colspan="2" align="center">Termin Beasiswa</th>
          <th width="40" align="center">1. Tagihan (INVOICE) BEASISWA</th>
          <th width="40" align="center">2. Beasiswa BPP Telah Di ITB (SP2D)</th>
          <th width="40" align="center">3. Beasiswa BPP Telah Ke ITB</th>
        </tr>
        <tr>
          <th colspan="11" style="background-color:#FFC000"></th>
          <th width="20" align="center" style="background-color:#FFC000">Tanggal Tagihan</th>
          <th width="20" align="center" style="background-color:#FFC000">Jatuh Tempo</th>
          <th rowspan="2" align="center" style="background-color:#66FFFF">@if($beasiswa->date==null) - @else{{strftime('%d %B %Y',strtotime($beasiswa->date))}} @endif</th>
          <th rowspan="2" align="center" style="background-color:#66FFFF">@if($beasiswa->date_sp2d==null)-@else{{strftime('%d %B %Y',strtotime($beasiswa->date_sp2d))}}@endif</th>
          <th rowspan="2" align="center" style="background-color:#66FFFF">@if($beasiswa->date_pay==null)-@else{{strftime('%d %B %Y',strtotime($beasiswa->date_pay))}}@endif</th>
        </tr>
        <tr>
          <th colspan="11"></th>
          <th align="center" style="background-color:#66FFFF">@if($beasiswa->date==null) - @else{{strftime('%d %B %Y',strtotime($beasiswa->date))}}@endif</th>
          <th align="center" style="background-color:#66FFFF">@if($beasiswa->date_end==null) - @else{{strftime('%d %B %Y',strtotime($beasiswa->date_end))}}@endif</th>
        </tr>
      </thead>
      @php
        $no=1;
      @endphp
      <tbody>
        @foreach ($mahasiswa as $key)
        <tr>
          <td align="center">{{$no++}}</td>
          <td>{{$beasiswa->source}}</td>
          <td align="center">{{$beasiswa->year}}</td>
          <td align="center">{{$beasiswa->spk}}</td>
          <td align="center">{{$beasiswa->type}}</td>
          <td align="center">{{$key->nim_colleger}}</td>
          <td>{{$key->colleger->name}}</td>
          <td align="center">@if($key->colleger->chapter==1)Ganjil @elseif($key->colleger->chapter==2)Genap @else- @endif</td>
          <td align="center">@if($key->colleger->program==1){{'Magister(S2)'}} @else{{'Doctor(S3)'}} @endif</td>
          <td>{{$key->colleger->prodi}}</td>
          <td>{{$key->colleger->faculty}}</td>
          <td colspan="2" align="center">@if($beasiswa->termin==null) Belum @else{{$beasiswa->termin}} @endif</td>
          <td align="center" @if($beasiswa->date==null)style="background-color:#A6A6A6" @else style="background-color:#FFCCFF" @endif>@if($beasiswa->date==null){{'Belum'}}@else{{'Sudah'}}@endif</td>
          <td align="center" @if($beasiswa->date_sp2d==null)style="background-color:#A6A6A6" @else style="background-color:#FFCCFF" @endif>@if($beasiswa->date_sp2d==null){{'Belum'}}@else{{'Sudah'}}@endif</td>
          <td align="center" @if($beasiswa->date_pay==null)style="background-color:#A6A6A6" @else style="background-color:#FFCCFF" @endif>@if($beasiswa->date_pay==null){{'Belum'}}@else{{'Sudah'}}@endif</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>

  </body>
</html>
