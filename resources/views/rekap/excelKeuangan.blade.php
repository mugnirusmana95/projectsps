@include('time')

<!DOCTYPE html>
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
        <td colspan="18"><h1>Laporan Keuangan {{$s->source}} - {{$ar->termin}}</h1></td>
      </tr>
    </table>

    <table class="table">
      <thead>
        <tr valign="center">
          <th height="35" align="center" style="background-color:#FFC000">No</th>
          <th align="center" style="background-color:#FFC000">Sumber Beasiswa</th>
          <th align="center" style="background-color:#FFC000">Tahun SPK</th>
          <th align="center" style="background-color:#FFC000">No. SPK</th>
          <th align="center" style="background-color:#FFC000">Jenis Beasiswa</th>
          <th align="center" style="background-color:#FFC000">Nama</th>
          <th align="center" style="background-color:#FFC000">NIM</th>
          <th align="center" style="background-color:#FFC000">Sem. Masuk (GJ/GN)</th>
          <th align="center" style="background-color:#FFC000">Jenjang Studi</th>
          <th align="center" style="background-color:#FFC000">Prodi</th>
          <th align="center" style="background-color:#FFC000">Fakultas</th>
          <th align="center" style="background-color:#FFC000">Batas Akhir Studi (ITB)</th>
          <th align="center" style="background-color:#FFC000">Batas Akhir Studi (ITB) Dalam Semester</th>
          <th align="center" style="background-color:#FFC000">Periode Akhir Beasiswa</th>
          <th align="center" style="background-color:#FFC000">Periode Akhir Beasiswa Dalam Semester</th>
          <th align="center" style="background-color:#FFC000">Status Studi Pada Semester Berjalan (Aktif/Lulus/DO/UNDRI/Dalam Proses DO atau UNDRI)</th>
          <th align="center" style="background-color:#FFC000">Status Studi Pada Semester Sebelumnya (Aktif/Lulus/DO/UNDRI/Dalam Proses DO atau UNDRI)</th>
          <th align="center" style="background-color:#FFC000">Tgl/Bln/Tahun Status Studi (Lulus/DO/UNDRI)</th>
        </tr>
      </thead>
      @php
        $no=1
      @endphp
      <tbody>
        @foreach ($ard as $key)
        <tr>
          <td align="center">{{$no++}}</td>
          <td align="center">{{$s->source}}</td>
          <td align="center">{{$s->year}}</td>
          <td align="center">{{$s->spk}}</td>
          <td align="center">{{$s->type}}</td>
          <td>{{$key->colleger->nama_lengkap}}</td>
          <td align="center">{{$key->nim_colleger}}</td>
          <td align="center">{{$key->colleger->semester}}</td>
          <td align="center">{{$key->colleger->strata}}</td>
          <td>{{$key->colleger->prody->nama_prodi}}</td>
          <td>{{$key->colleger->fak_id}}</td>
          <td align="center">{{$key->colleger->tgl_akhir}}</td>
          <td align="center">13</td>
          <td align="center">@if($key->chapter2==1){{'Ganjil'}}@else{{'Genap'}} {{$key->year2}}@endif</td>
          <td align="center">@if($key->chapter2==1){{'Sem.1'}}@else{{'Sem.2'}} {{$key->year2}}/{{$key->year2+1}}@endif</td>
          <td align="center">{{$key->colleger->status}}</td>
          <td align="center">-</td>
          <td align="center">@if($key->colleger->status=="Lulus"){{$key->colleger->tgl_lulus}}@elseif($key->colleger->status=="DO" || $key->colleger->status=="Undri"){{$key->tgl_do}}@endif</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </body>
</html>
