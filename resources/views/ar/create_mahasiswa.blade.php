@extends('index')

@include('time')

@section('title')
  Tambah Mahasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Mahasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/tagihan"> Tagihan Beasiswa</a></li>
    <li><a href="/tagihan/lihat/{{$id}}"> Detail Tagihan Beasiswa</a></li>
    <li class="active"> Tambah Mahasiswa</li>
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
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
      <div class="box-header">
        <h3>Data Beasiswa</h3>
      </div>
      <div class="box-body">
        <table class="table">
          <tr>
            <td width="20%">No SPK</td>
            <td width="1%">:</td>
            <td>{{$ar->Scholarship->spk}}</td>
          </tr>
          <tr>
            <td>Tahun SPK</td>
            <td>:</td>
            <td>{{$ar->Scholarship->year}}</td>
          </tr>
          <tr>
            <td>Sumber Beasiswa</td>
            <td>:</td>
            <td>{{$ar->Scholarship->source}}</td>
          </tr>
          <tr>
            <td>Jenis Beasiswa</td>
            <td>:</td>
            <td>{{$ar->Scholarship->type}}</td>
          </tr>
          <tr>
            <td>Total Beasiswa</td>
            <td>:</td>
            <td>Rp {{number_format($ar->Scholarship->value,0,'.','.')}},-</td>
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
          <h3>Data Tagihan</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td width="20%">No SPK & Termin</td>
              <td width="1%">:</td>
              <td>{{$ar->invoice}} & {{$ar->termin}} ({{$ar->Scholarship->source}} {{$ar->Scholarship->year}})</td>
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
          <h3>Daftar Penerima Beasiswa</h3>
        </div>
        <div class="box-body">
          <form class="form-horizontal" action="/tagihan/mahasiswa/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id='example1'>
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

            <div class="table-responsive">
              <table class="table table-hover table-bordered" id='pTable'>
                <theader>
                  <tr>
                    <th rowspan="3" width="1%" rowspan="3"><center>No</center></th>
                    <th rowspan="3" width="15%" rowspan="2">Mahasiswa <span class="req">*</span></th>
                    <th rowspan="3" width="8%" rowspan="2">Sem. Masuk<span class="req">*</span></th>
                    <th colspan="5"><center>Masa Beasiswa</center></th>
                    <th colspan="2"><center>Semester Penagihan</center></th>
                    <th rowspan="3" width="5%" rowspan="2"><center>Jml. SKS</center></th>
                    <th rowspan="3" width="10%"><center>BPP</center></th>
                    <th rowspan="3" width="10%"><center>Pengelolaan</center></th>
                    <th rowspan="3" width="10%"><center>Biaya Hidup</center></th>
                    <th rowspan="3" width="10%"><center>Biaya Buku</center></th>
                    <th rowspan="3" width="10%"><center>Biaya Penelitian</center></th>
                    <th width="1%" rowspan="3"><center>Aksi</center></th>
                  </tr>
                  <tr>
                    <th colspan="2"><center>Sem. Awal Beasiswa</center></th>
                    <th colspan="2"><center>Sem. Akhir Beasiswa</center></th>
                    <th rowspan="2" width="6%"><center>Jml. Sem.</center></th>
                    <th rowspan="2" width="8%"><center>Sem.<span class="req">*</span></center></th>
                    <th rowspan="2" width="7%"><center>Thn.<span class="req">*</span></center></th>
                  </tr>
                  <tr>
                    <th width="8%">Sem.<span class="req">*</span></th>
                    <th width="7%">Thn.<span class="req">*</span></th>
                    <th width="8%">Sem.<span class="req">*</span></th>
                    <th width="7%">Thn.<span class="req">*</span></th>
                  </tr>
                </theader>
                <tbody>

                </tbody>
              </table>
            </div>

            <table class="table">
              <tbody>
                <tr>
                  <td><a  href="javascript:;" class="btn btn-md btn-warning" id='addButId'>Tambah Field</a></td>
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
      var sno=$('#pTable tr').length-2; //length+1;
      //Menghilangkan tombol tambah data
      trow =  "<tr><td><center>"+sno+"</center></td>"+
              "<td><select class='form-control select' name='nim[]' id='nim"+sno+"' required>"+
              "</select></td>"+
              "<td><input type='text' class='form-control' name='semestermasuk[]' id='semmasuk"+sno+"' readonly style='background-color:#fff'></td>"+
              "<td>"+
              "<select class='form-control' name='semester1[]' id='sem1"+sno+"' required>"+
              "<option value='1'>Gj</option>"+
              "<option value='2'>Gn</option>"+
              "</select>"+
              "</td>"+
              "<td><input type='text' class='form-control' name='tahun1[]' id='thn1"+sno+"' minlength='4' maxlength='4' required></td>"+
              "<td>"+
              "<select class='form-control' name='semester2[]' id='sem2"+sno+"' required>"+
              "<option value='1'>Gj</option>"+
              "<option value='2'>Gn</option>"+
              "</select>"+
              "</td>"+
              "<td><input type='text' class='form-control' name='tahun2[]' id='thn2"+sno+"' minlength='4' maxlength='4' required></td>"+
              "<td><input type='text' class='form-control' name='jmlsemester[]' id='sem"+sno+"'></td>"+
              "<td>"+
              "<select class='form-control' name='semester3[]' id='sem3"+sno+"' required>"+
              "<option value='1'>Gj</option>"+
              "<option value='2'>Gn</option>"+
              "</select>"+
              "</td>"+
              "<td><input type='text' class='form-control' name='tahun3[]' id='thn3"+sno+"' minlength='4' maxlength='4' required></td>"+
              "<td><input type='text' class='form-control' name='jmlsks[]' id='sks"+sno+"'></td>"+
              "<td><input type='text' class='form-control' name='bpp[]' id='bpp"+sno+"' value=''></td>"+
              "<td><input type='text' class='form-control' name='pengelolaan[]' id='pengelolaan"+sno+"' value='@if($scholarship->bpp>0){{number_format($scholarship->bpp,0,'.','.')}}@endif'></td>"+
              "<td><input type='text' class='form-control' name='hidup[]' id='hidup"+sno+"' value=''></td>"+
              "<td><input type='text' class='form-control' name='buku[]' id='buku"+sno+"' value=''></td>"+
              "<td><input type='text' class='form-control' name='penelitian[]' id='penelitian"+sno+"' value=''></td>"+
              "<td><button data-toggle='tooltip' title='Hapus' type='button' class='btn btn-danger rButton'><span class='fa fa-trash'></span></button></td></tr>";
      $('#pTable').append(trow);
      $('.select').select2({
        placeholder: "Pilih Mahasiswa",
        ajax: {
            url: '{{ route('ar.find.student') }}',
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
        $.get("/beasiswa/mahasiswa/semester/"+val, function(response3){
          $('#semmasuk'+sno).val(response3.mahasiswa.semester+' '+response3.mahasiswa.thn_akademik);
        });
      });

      $("#sks"+sno).keyup(function(){
        var sks = $("#sks"+sno).val();
        var nim = $("#nim"+sno).val();
        if(nim==='' || nim===null) {
          alert("Mahasiswa masih kosong, harap pilih mahasiswa terlebih dahulu");
          $(this).val('');
        } else {
          $.get("/beasiswa/mahasiswa/hitung/"+sks+"/"+nim, function(response4){
            $("#bpp"+sno).val(response4)
          });
        }
      });

      $("#sem"+sno).keyup(function(){
        var sem = $(this).val();
        var nim = $("#nim"+sno).val();
        if(nim==='' || nim===null) {
          alert("Mahasiswa masih kosong, harap pilih mahasiswa terlebih dahulu");
          $(this).val('');
        } else {
          $.get("/beasiswa/mahasiswa/cek/semester/"+nim+"/"+sem, function(response5){
            $("#sem1"+sno).val(response5.semester1).prop('selected',true);
            $("#thn1"+sno).val(response5.tahun1);
            $("#sem2"+sno).val(response5.semester2).prop('selected',true);
            $("#thn2"+sno).val(response5.tahun2);
          });
        }
      });

      $("#thn3"+sno).keyup(function(){
        var nim = $("#nim"+sno).val();
        var thn = $(this).val();
        var sem = $("#sem3"+sno).val();
        if(nim=="" || nim==null){
          alert("Mahasiswa masih kosong, harap pilih mahasiswa terlebih dahulu");
          $(this).val('');
        } else {
          $.get("/tagihan/cek/tagihan/"+nim+"/"+thn+"/"+sem, function(response6){
            if(response6>0){
              alert('Beasiswa Sudah Ditagihkan');
              $("#thn3"+sno).val("");
            }
          });
        }
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
