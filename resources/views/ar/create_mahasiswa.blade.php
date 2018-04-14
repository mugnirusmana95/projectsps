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
            <td>Rp {{number_format($ar->Scholarship->value)}}.00,-</td>
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
              <td>Total Tagihan</td>
              <td>:</td>
              <td>Rp {{number_format($ar->tagihan)}}.00,-</td>
            </tr>
            <tr>
              <td>Total Pengelolaan</td>
              <td>:</td>
              <td>Rp {{number_format($ar->pengelolaan)}}.00,-</td>
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
        <div class="box-body">
          <form class="form-horizontal" action="/tagihan/mahasiswa/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id='example1'>
                <thead>
                  <tr>
                    <th width="1%"><center>No</center></th>
                    <th>Mahasiswa</th>
                    <th width="10%"><center>Sem. Awal Beasiswa</center></th>
                    <th width="10%"><center>Sem. Akhir Beasiswa</center></th>
                    <th width="6%"><center>Jml. SKS</center></th>
                    <th width="6%"><center>Jml. Sem.</center></th>
                    <th width="15%"><center>BPP</center></th>
                    <th width="15%"><center>Pengelolaan</center></th>
                    <th width="10%"><center>Aksi</center></th>
                  </tr>
                </thead>
                @php
                  $no = 1;
                @endphp
                <tbody>
                  @foreach ($ard as $key)
                    <tr>
                      <td><center>{{$no++}}</center></td>
                      <td>{{$key->nim_colleger}} - {{$key->colleger->name}}</td>
                      <td><center>@if($key->chapter1 == 1) Ganjil @else Genap @endif / {{$key->year1}}</center></td>
                      <td><center>@if($key->chapter2 == 1) Ganjil @else Genap @endif / {{$key->year2}}</center></td>
                      <td><center>{{$key->total_sks}}</center></td>
                      <td><center>{{$key->total_chapter}}</center></td>
                      <td align="right">Rp @if ($key->bpp == null) 0 @else {{number_format($key->bpp)}} @endif.00,-</td>
                      <td align='right'>Rp @if ($key->pengelolaan == null) 0 @else {{number_format($key->pengelolaan)}} @endif.00,-</center></td>
                      <td>
                        <a href="" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="/tagihan/mahasiswa/hapus/{{crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
                    <th width="1%" rowspan="2"><center>No</center></th>
                    <th width="20%" rowspan="2">Mahasiswa <span class="req">*</span></th>
                    <th colspan="2"><center>Awal</center></th>
                    <th colspan="2"><center>Akhir</center></th>
                    <th width="6%" rowspan="2"><center>Jml. SKS</center></th>
                    <th width="5%" rowspan="2"><center>Jml. Sem.</center></th>
                    <th rowspan="2"><center>BPP</center></th>
                    <th rowspan="2"><center>Pengelolaan</center></th>
                    <th width="1%" rowspan="2"><center>Aksi</center></th>
                  </tr>
                  <tr>
                    <th width="5%"><center>Semester<span class="req">*</span></center></th>
                    <th width="8%"><center>Tahun <span class="req">*</span></center></th>
                    <th width="5%"><center>Semester<span class="req">*</span></center></th>
                    <th width="8%"><center>Tahun<span class="req">*</span></center></th>
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
            "<td width='20%'><select class='form-control select' name='nim[]' id='nim"+sno+"' required>"+
            // "<option></option>"+
            // "@foreach($colleger as $key)"+
            // "<option value='{{$key->nim}}'>{{$key->nim}} - {{$key->name}}</option>"+
            // "@endforeach"+
            "</select></td>"+
            "<td width='10%'>"+
            "<select class='form-control' name='semester1[]' required>"+
            "<option value='1'>Ganjil</option>"+
            "<option value='2'>Genap</option>"+
            "</select>"+
            "</td>"+
            "<td><input type='text' class='form-control' name='tahun1[]' required></td>"+
            "<td width='10%'>"+
            "<select class='form-control' name='semester2[]' required>"+
            "<option value='1'>Ganjil</option>"+
            "<option value='2'>Genap</option>"+
            "</select>"+
            "</td>"+
            "<td><input type='text' class='form-control' name='tahun2[]' required></td>"+
            "<td><input type='text' class='form-control' name='jmlsks[]' id='sks"+sno+"'></td>"+
            "<td><input type='text' class='form-control' name='jmlsemester[]'></td>"+
            "<td><input type='text' class='form-control' id='bpp"+sno+"' name='bpp[]'></td>"+
            "<td><input type='text' class='form-control' id='pengelolaan"+sno+"' name='pengelolaan[]' value='@if($scholarship->bpp==null || $scholarship->bpp==0)0 @else{{number_format($scholarship->bpp,0,'.','.')}} @endif'></td>"+
            "<td width='1%'><button data-toggle='tooltip' title='Hapus' type='button' class='btn btn-danger rButton'><span class='fa fa-trash'></span></button></td></tr>";
            $('#pTable').append(trow);
            $('.select').select2({
              placeholder: "Pilih Mahasiswa",
              ajax: {
                  url: '{{ route('admin.find.student') }}',
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
                $('#bpp'+sno).val(response3)
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
