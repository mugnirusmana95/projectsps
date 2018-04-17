@extends('index')

@include('layouts.terbilang')

@section('title')
  Tambah Mahasiswa (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Mahasiswa (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/beasiswa"> Beasiswa (SPK)</a></li>
    <li><a href="/beasiswa/lihat/{{$id}}"> Detail Beasiswa (SPK)</a></li>
    <li class="active"> Tambah Mahasiswa (SPK)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">

          @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{Session::get('success')}}
          </div>
          @elseif(Session::has('error'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-close"></i> Error!</h4>
            {{Session::get('error')}}
          </div>
          @elseif(count($errors) > 0)
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-close"></i> Error!</h4>
            Data gagal disimpan.
          </div>
          @else
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info-circle"></i> Info!</h4>
            Field dengan tanda (<span class="req">*</span>) wajib diisi.
          </div>
          @endif

          @if($total->total > $scholarship->value)
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> Info!</h4>
            Pemegang Beasiswa Melebihi Dari Total Beasiswa
          </div>
          @elseif($total->total < $scholarship->value)
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> Info!</h4>
            Pemegang Beasiswa Kurang Dari Total Beasiswa
          </div>
          @endif

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
              <td>Rp {{number_format($scholarship->value,0,'.','.')}},-</td>
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
          <h3>Daftar Pemegang Beasiswa</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" action="/beasiswa/mahasiswa/simpan/{{$id}}" method="post">
            {{ csrf_field() }}

              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th width="1%"><center>No</center></th>
                      <th width="15%">Mahasiswa</th>
                      <th width="1%"><center>Sem. Awal Beasiswa</center></th>
                      <th width="1%"><center>Sem. Akhir Beasiswa</center></th>
                      <th width="1%"><center>Jml. SKS</center></th>
                      <th width="1%"><center>Jml. Sem.</center></th>
                      <th width="15%"><center>BPP</center></th>
                      <th width="15%"><center>Pengelolaan</center></th>
                      <th width="15%"><center>Biaya Hidup</center></th>
                      <th width="15%"><center>Biaya Buku</center></th>
                      <th width="15%"><center>Biaya Penelitian</center></th>
                      <th width="10%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  @php
                    $no=1;
                    $col = count($colleger2);
                  @endphp
                  <tbody>
                    @foreach ($colleger2 as $key)
                    <tr>
                      <td><center>{{$no++}}</center></td>
                      <td>{{$key->nim_colleger}} - {{$key->colleger->nama_lengkap}}</td>
                      <td><center>@if($key->chapter1 == 1) Gj @else Gn @endif / {{$key->year1}}</center></td>
                      <td><center>@if($key->chapter2 == 1) Gn @else Gj @endif / {{$key->year2}}</center></td>
                      <td><center>{{$key->total_sks}}</center></td>
                      <td><center>{{$key->total_chapter}}</center></td>
                      <td align="right">Rp @if ($key->bpp == null || $key->bpp==0){{'0'}}@else {{number_format($key->bpp,0,'.','.')}} @endif,-</td>
                      <td align='right'>Rp @if ($key->pengelolaan == null || $key->pengelolaan==0){{'0'}}@else{{number_format($key->pengelolaan,0,'.','.')}}@endif,-</center></td>
                      <td align='right'>Rp @if ($key->biaya_hidup == null || $key->biaya_hidup==0){{'0'}}@else{{number_format($key->biaya_hidup,0,'.','.')}}@endif,-</center></td>
                      <td align='right'>Rp @if ($key->biaya_buku == null || $key->biaya_buku==0){{'0'}}@else{{number_format($key->biaya_buku,0,'.','.')}}@endif,-</center></td>
                      <td align='right'>Rp @if ($key->biaya_penelitian == null || $key->biaya_penelitian==0){{'0'}}@else{{number_format($key->biaya_penelitian,0,'.','.')}}@endif,-</center></td>
                      <td>
                          <a href="/beasiswa/mahasiswa/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning btn-block"><span class="fa fa-edit"></span></a>
                          <a href="/beasiswa/mahasiswa/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger btn-block"><span class="fa fa-trash"></span></a>
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td colspan="2" align="right"><h4><b>Total :</b></h4></td>
                      <td colspan="9" align="right"><h3><b>Rp. {{number_format($total->total,0,'.','.')}},-</b></h3></td>
                      <td rowspan="2">
                        <div style="width:100%;min-height:110px;margin:auto;padding:auto;background-color: @if($total->total > $scholarship->value) #dd4b39 @elseif($total->total < $scholarship->value) #f39c12 @else #00c0ef @endif">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right"><h4><b>Terbilang :</b></h4></td>
                      <td colspan="9" align="right"><h4><b>@if($total->total>0){{terbilang($total->total)}} rupiah @endif</b></h4></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-bordered" id='pTable'>
                  <theader>
                    <tr>
                      <th width="1%" rowspan="2"><center>No</center></th>
                      <th width="15%" rowspan="2">Mahasiswa <span class="req">*</span></th>
                      <th colspan="2"><center>Awal Beasiswa</center></th>
                      <th colspan="2"><center>Akhir Beasiswa</center></th>
                      <th width="6%" rowspan="2"><center>Jml. SKS</center></th>
                      <th width="5%" rowspan="2"><center>Jml. Sem.</center></th>
                      <th rowspan="2"><center>BPP</center></th>
                      <th rowspan="2"><center>Pengelolaan</center></th>
                      <th rowspan="2"><center>Biaya Hidup</center></th>
                      <th rowspan="2"><center>Biaya Buku</center></th>
                      <th rowspan="2"><center>Biaya Penelitian</center></th>
                      <th width="1%" rowspan="2"><center>Aksi</center></th>
                    </tr>
                    <tr>
                      <th width="8%"><center>Sem.<span class="req">*</span></center></th>
                      <th width="7%"><center>Thn<span class="req">*</span></center></th>
                      <th width="8%"><center>Sem.<span class="req">*</span></center></th>
                      <th width="7%"><center>Thn.<span class="req">*</span></center></th>
                    </tr>
                  </theader>
                  <tbody>
                  </tbody>
                </table>
              </div>

              <table class="table">
                <tbody>
                  <tr>
                    <td><a  href="javascript:;" class="btn btn-md btn-warning @if($total->total > $scholarship->value)hide @endif" id='addButId'>Tambah Mahasiswa</a></td>
                  </tr>
                  <tr>
                    <td>
                      <button type="reset" class="btn btn-default">Reset</button>
                      <button type="submit" class="btn btn-info">Simpan</button>
                    </td>
                  </tr>
                  <tr>
                    <td>Catatan :&nbsp;&nbsp;1. Gj=Ganjil;&nbsp;&nbsp;2. Gn=Genap;&nbsp;&nbsp;3. Jml=Jumlah;&nbsp;&nbsp;4. Sem=Semester;&nbsp;&nbsp;</td>
                  </tr>
                </tbody>
              </table>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script>
  //Funsi untuk set nomor
  function arrangeSno() {
    var i=1;
    $('#pTable tr').each(function() {
    $(this).find(".sNo").html('Mahasiswa ('+i+') <span class="req">*</span>');
    //Memunculkan tombol tambah data
    i++;
    });
  }

  //Fungsi untuk menambah row
  $(document).ready(function(){
  $('#addButId').click(function(){
    var sno=$('#pTable tr').length-1; //length+1;
    //Menghilangkan tombol tambah data
    trow =  "<tr><td width='1%'><center>"+sno+"</center></td>"+
            "<td><select class='form-control select' name='nim[]' id='nim"+sno+"' required>"+
            "</select></td>"+
            "<td>"+
            "<select class='form-control' name='semester1[]' required>"+
            "<option value='1'>Gj</option>"+
            "<option value='2'>Gn</option>"+
            "</select>"+
            "</td>"+
            "<td><input type='text' class='form-control' name='tahun1[]' minlength='4' maxlength='4' required></td>"+
            "<td>"+
            "<select class='form-control' name='semester2[]' required>"+
            "<option value='1'>Gj</option>"+
            "<option value='2'>Gn</option>"+
            "</select>"+
            "</td>"+
            "<td><input type='text' class='form-control' name='tahun2[]' minlength='4' maxlength='4' required></td>"+
            "<td><input type='text' class='form-control' name='jmlsks[]' id='sks"+sno+"'></td>"+
            "<td><input type='text' class='form-control' name='jmlsemester[]'></td>"+
            "<td><input type='text' class='form-control' name='bpp[]' id='bpp"+sno+"' value=''></td>"+
            "<td><input type='text' class='form-control' name='pengelolaan[]' id='pengelolaan"+sno+"' value='@if($scholarship->bpp>0){{number_format($scholarship->bpp,0,'.','.')}}@endif'></td>"+
            "<td><input type='text' class='form-control' name='hidup[]' id='hidup"+sno+"' value=''></td>"+
            "<td><input type='text' class='form-control' name='buku[]' id='buku"+sno+"' value=''></td>"+
            "<td><input type='text' class='form-control' name='penelitian[]' id='penelitian"+sno+"' value=''></td>"+
            "<td width='1%'><button data-toggle='tooltip' title='Hapus' type='button' class='btn btn-danger rButton'><span class='fa fa-trash'></span></button></td></tr>";
            $('#pTable').append(trow);
            $('.select').select2({
              placeholder: "Pilih Mahasiswa",
              ajax: {
                  url: '{{ route('scholarship.find.student') }}',
                  dataType: 'json',
                  data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                  cache: true
              }
            });

            var bpp = document.getElementById('bpp'+sno);
            bpp.addEventListener('keyup', function(e)
            {
              bpp.value = formatRupiah(this.value);
            });

            var pengelolaan = document.getElementById('pengelolaan'+sno);
            pengelolaan.addEventListener('keyup', function(e)
            {
              pengelolaan.value = formatRupiah(this.value);
            });

            var hidup = document.getElementById('hidup'+sno);
            hidup.addEventListener('keyup', function(e)
            {
              hidup.value = formatRupiah(this.value);
            });

            var buku = document.getElementById('buku'+sno);
            buku.addEventListener('keyup', function(e)
            {
              buku.value = formatRupiah(this.value);
            });

            var penelitian = document.getElementById('penelitian'+sno);
            penelitian.addEventListener('keyup', function(e)
            {
              penelitian.value = formatRupiah(this.value);
            });

            function formatRupiah(angka, prefix)
            {
              var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split	= number_string.split(','),
                sisa 	= split[0].length % 3,
                rupiah 	= split[0].substr(0, sisa),
                ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);

              if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
              }

              rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
              return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            $("#nim"+sno).change(function(){
              var val = $(this).val();

              $.get("/beasiswa/mahasiswa/search/"+val, function(response3){
                if(response3=='0' || response=='' || response3==0) {
                  $('#bpp'+sno).val('')
                } else {
                  $('#bpp'+sno).val(response3)
                }
              });
            });

            $("#sks"+sno).keyup(function(){
              var sks = $("#sks"+sno).val();
              var nim = $("#nim"+sno).val();
              $.get("/beasiswa/mahasiswa/hitung/"+sks+"/"+nim, function(response4){
                $("#bpp"+sno).val(response4)
              });
            });
    });
  });

  //Fungsi untuk menghapus row
  $(document).on('click', 'button.rButton', function () {
    $(this).closest('tr').remove();
    arrangeSno();
    return false;
  });

  function coba(){
    $('#addButId').attr('disabled','disabled');
  }

</script>
@endsection
