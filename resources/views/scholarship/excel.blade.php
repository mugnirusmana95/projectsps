<!DOCTYPE html>
@include('time')

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
        <td colspan="8"><b>DATA BEASISWA (SPK)</b></td>
      </tr>
    </table>

    <table class="table">
      <tr>
        <td colspan="3" style="background-color:#FFC000"><b>No SPK</b></td>
        <td colspan="5" align="left">{{$data1->spk}}</td>
      </tr>
      <tr>
        <td colspan="3" style="background-color:#FFC000"><b>Tahun SPK</b></td>
        <td colspan="5" align="left">{{$data1->year}}</td>
      </tr>
      <tr>
        <td colspan="3" style="background-color:#FFC000"><b>Jenis Beasiswa</b></td>
        <td colspan="5" align="left">{{$data1->type}}</td>
      </tr>
      <tr>
        <td colspan="3" style="background-color:#FFC000"><b>Sumber Beasiswa</b></td>
        <td colspan="5" align="left">{{$data1->source}}</td>
      </tr>
      <tr>
        <td colspan="3" style="background-color:#FFC000"><b>Total Beasiswa</b></td>
        <td colspan="5" align="left">Rp. {{number_format($data1->value,0,'.','.')}}</td>
      </tr>
    </table>

    @if(count($data2)>0)
      <table class="table2">
        <tr class="table2">
          <td class="table2"></td>
        </tr>
        <tr class="table2">
          <td class="table2"></td>
        </tr>
      </table>

      <table class="table">
        <tr>
          <td colspan="8"><b>DATA TERMIN BEASISWA (SPK)<b></td>
        </tr>
      </table>

      <table class="table">
        <thead>
          <tr style="background-color:#FFC000" valign="center">
            <th align="center">No</th>
            <th align="center">Nama Termin</th>
            <th align="center">Tanggal Tagihan</th>
            <th align="center">Jatuh Tempo</th>
            <th align="center">Total Beasiswa</th>
            <th align="center">Total Pengelolaan</th>
          </tr>
        </thead>
        @php
          $no_termin=1;
        @endphp
        <tbody>
          @foreach ($data2 as $key)
          <tr valign="center">
            <td align="center">{{$no_termin++}}</td>
            <td>{{$key->name}}</td>
            <td align="center">{{$key->date}}</td>
            <td align="center">{{$key->date_end}}</td>
            <td align="right">Rp. {{number_format($key->bpp,0,'.','.')}},-</td>
            <td align="right">Rp. {{number_format($key->pengelolaan,0,'.','.')}},-</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4" style="background-color:#FFC000" align="right"><b>Total</b></td>
            <td align="right"><b>Rp. {{number_format($total_termin,0,'.','.')}},-</b></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    @endif

    @if (count($data3)>0)
      <table class="table2">
        <tr class="table2">
          <td class="table2"></td>
        </tr>
        <tr class="table2">
          <td class="table2"></td>
        </tr>
      </table>

      <table class="table">
        <tr>
          <td colspan="8"><b>DATA PEMEGANG BEASISWA (SPK)</b></td>
        </tr>
      </table>

      <table>
        <thead>
          <tr style="background-color:#FFC000" valign="center">
            <th align="center">No</th>
            <th align="center">NIM</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Semester</th>
            <th align="center">Program</th>
            <th align="center">Fakultas</th>
            <th align="center">Prodi</th>
            <th align="center">Sem. Awal Beasiswa</th>
            <th align="center">Sem. Akhir Beasiswa</th>
            <th align="center">Jumlah SKS</th>
            <th align="center">Jumlah Semester</th>
            <th align="center">BPP</th>
            <th align="center">Pengelolaan</th>
          </tr>
        </thead>
        @php
          $no_mahasiswa=1;
        @endphp
        <tbody>
          @foreach ($data3 as $key)
            <tr valign="center">
              <td align="center">{{$no_mahasiswa++}}</td>
              <td align="center">{{$key->nim_colleger}}</td>
              <td>{{$key->colleger->name}}</td>
              <td align="center">
                  @if($key->colleger->chapter==1)
                    Ganjil
                  @elseif($key->colleger->chapter==2)
                    Genap
                  @else
                    -
                  @endif
              </td>
              <td align="center">
                @if($key->colleger->program==1)
                  Magister (S2)
                @else
                  Doktor (S3)
                @endif</td>
              <td>{{$key->colleger->faculty}}</td>
              <td>{{$key->colleger->prodi}}</td>
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
              <td align="center">{{$key->total_sks}}</td>
              <td align="center">{{$key->total_chapter}}</td>
              <td align="right">Rp. {{number_format($key->bpp,0,'.','.')}},-</td>
              <td align="right">Rp. {{number_format($key->pengelolaan,0,'.','.')}},-</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="11" style="background-color:#FFC000" align="right"><b>Total</b></td>
            <td align="right"><b>Rp. {{number_format($total_colleger,0,'.','.')}}</b></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    @endif
    <table class="table2">
      <tr class="table2">
        <td class="table2"></td>
      </tr>
    </table>
  </body>
</html>
