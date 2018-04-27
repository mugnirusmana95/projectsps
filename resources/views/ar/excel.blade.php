<!DOCTYPE html>
@include('time')

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/table.css')}}">
  </head>
  <body>
    @if(count($data1)>0)
    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="17"><b>DATA BEASISWA (SPK)</b></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>No SPK</b></td>
        <td colspan="15" align="left">{{$data2->spk}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Tahun SPK</b></td>
        <td colspan="15" align="left">{{$data2->year}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Jenis Beasiswa</b></td>
        <td colspan="15" align="left">{{$data2->type}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Sumber Beasiswa</b></td>
        <td colspan="15" align="left">{{$data2->source}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Total Beasiswa</b></td>
        <td colspan="15" align="left">Rp. {{number_format($data2->value,0,'.','.')}}</td>
      </tr>
    </table>
    @endif

    @if(count($data1))
    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="17"><b>DATA TAGIHAN (INVOICE)</b></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>No Invoice</b></td>
        <td colspan="15" align="left">{{$data1->invoice}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Termin / Beasiswa</b></td>
        <td colspan="15" align="left">{{$data1->termin}} / {{$data1->scholarship->source}} - {{$data1->scholarship->year}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Tanggal Tagihan</b></td>
        <td colspan="15" align="left">{{strftime('%d %B %Y',strtotime($data1->date))}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Jatuh Tempo</b></td>
        <td colspan="15" align="left">{{strftime('%d %B %Y',strtotime($data1->date_end))}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Total BPP</b></td>
        <td colspan="15" align="left">Rp. {{number_format($total->bpp,0,'.','.')}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Total Pengelolaan</b></td>
        <td colspan="15" align="left">Rp. {{number_format($total->pengelolaan,0,'.','.')}}</td>
      </tr>
      <tr>
        <td colspan="2" style="background-color:#FFC000"><b>Total Tagihan</b></td>
        <td colspan="15" align="left">Rp. {{number_format($total->tagihan,0,'.','.')}}</td>
      </tr>
    </table>
    @endif

    @if(count($data3)>0)
    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="17"><b>DATA PENERIMA BEASISWA</b></td>
      </tr>
    </table>
    @php
      $no_mahasiswa=1;
    @endphp
    <table>
      <thead>
        <tr style="background-color:#FFC000" valign="center">
          <th width="6" rowspan="2" align="center">No</th>
          <th width="15" rowspan="2" align="center">NIM</th>
          <th width="50" rowspan="2" align="center">Nama Lengkap</th>
          <th width="15" rowspan="2" align="center">Semester</th>
          <th width="15" rowspan="2" align="center">Program</th>
          <th width="15" rowspan="2" align="center">Fakultas</th>
          <th width="60" rowspan="2" align="center">Prodi</th>
          <th width="60" colspan="3" align="center">Masa Beasiswa</th>
          <th width="25" rowspan="2" align="center">Semester Penagihan</th>
          <th width="20" rowspan="2" align="center">Jumlah SKS</th>
          <th width="20" rowspan="2" align="center">BPP</th>
          <th width="20" rowspan="2" align="center">Pengelolaan</th>
          <th width="20" rowspan="2" align="center">Biaya Hidup</th>
          <th width="20" rowspan="2" align="center">Biaya Buku</th>
          <th width="20" rowspan="2" align="center">Biaya Penelitian</th>
        </tr>
        <tr>
          <th colspan="7"></th>
          <th width="20" align="center" style="background-color:#FFC000">Awal Beasiswa</th>
          <th width="20" align="center" style="background-color:#FFC000">Akhir Beasiswa</th>
          <th width="20" align="center" style="background-color:#FFC000">Jumlah Semester</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data3 as $key)
          <tr valign="center">
            <td align="center">{{$no_mahasiswa++}}</td>
            <td align="center">{{$key->nim_colleger}}</td>
            <td>{{$key->colleger->nama_lengkap}}</td>
            <td align="center">{{$key->colleger->semester}} / {{$key->colleger->thn_akademik}}</td>
            <td align="center">{{$key->colleger->strata}}</td>
            <td>{{$key->colleger->fak_id}}</td>
            <td>{{$key->colleger->prody->nama_prodi}}</td>
            <td align="center">
              @if($key->chapter1==1)
                Ganjil
              @else
                Genap
              @endif
               - {{$key->year1}}
            </td>
            <td align="center">
              @if($key->chapter2==1)
                Ganjil
              @else
                Genap
              @endif
               - {{$key->year2}}
            </td>
            <td align="center">{{$key->total_chapter}}</td>
            <td align="center">
              @if($key->chapter3==1)
                Ganjil
              @else
                Genap
              @endif
               - {{$key->year3}}
            </td>
            <td align="center">{{$key->total_sks}}</td>
            <td align="right">@if($key->bpp>0){{number_format($key->bpp,0,'.','.')}}@else{{'0'}}@endif</td>
            <td align="right">@if($key->pengelolaan>0){{number_format($key->pengelolaan,0,'.','.')}}@else{{'0'}}@endif</td>
            <td align="right">@if($key->biaya_hidup>0){{number_format($key->biaya_hidup,0,'.','.')}}@else{{'0'}}@endif</td>
            <td align="right">@if($key->biaya_buku>0){{number_format($key->biaya_buku,0,'.','.')}}@else{{'0'}}@endif</td>
            <td align="right">@if($key->biaya_penelitian>0){{number_format($key->biaya_penelitian,0,'.','.')}}@else{{'0'}}@endif</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif

  </body>
</html>
