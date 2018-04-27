@extends('index')

@section('title')
  Tambah Mahasiswa (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Termin (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/beasiswa"> Beasiswa (SPK)</a></li>
    <li><a href="/beasiswa/lihat/{{$id}}"> Detail Beasiswa (SPK)</a></li>
    <li class="active"> Tambah Termin (SPK)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/beasiswa/termin/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
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

            @if($total > $scholarship->value)
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Info!</h4>
              Total Termin Melebihi Dari Total Beasiswa
            </div>
            @elseif($total < $scholarship->value)
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Info!</h4>
              Total Termin Kurang Dari Total Beasiswa
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

            <hr>
            <h3>Tambah Termin</h3>
            <hr>

            <div class="table-responsive">
              <table class="table table-hover table-bordered" id='pTable'>
                <thead>
                  <tr>
                    <th width="1%"><center>No</center></th>
                    <th>Nama Termin <span class="req">*</span></th>
                    <th width="17%"><center>Total BPP <span class="req">*</span></center></th>
                    <th width="17%"><center>Total Pengelolaan <span class="req">*</span></center></th>
                    <th width="15%"><center>Tanggal Tagihan <span class="req">*</span></center></th>
                    <th width="15%"><center>Jatuh Tempo <span class="req">*</span></center></th>
                    <th width="9%"><center>Aksi</center></th>
                  </tr>
                </thead>
                @php
                  $no=1;
                @endphp
                <tbody>
                  @foreach ($termin as $key)
                  <tr>
                    <td><center>{{$no++}}</center></td>
                    <td>{{$key->name}}</td>
                    <td align='right'>Rp @if($key->bpp == null){{'0'}}@else{{number_format($key->bpp,0,'.','.')}}@endif,-</td>
                    <td align='right'>Rp @if($key->pengelolaan == null){{'0'}}@else{{number_format($key->pengelolaan,0,'.','.')}}@endif,-</td>
                    <td><center>{{$key->date}}</center></td>
                    <td><center>{{$key->date_end}}</center></td>
                    <td>
                        @if($key->id_ar==null)
                        <a href="/beasiswa/termin/ubah/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="/beasiswa/termin/hapus/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                        @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <table class="table">
              <tbody>
                <tr>
                  <td><a  href="javascript:;" class="btn btn-md btn-warning" id='addButId'>Tambah Termin</a></td>
                </tr>
                <tr>
                  <td>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </form>
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
    $(this).find(".sNo").html(i);
    //Memunculkan tombol tambah data
    i++;
    });
  }

  //Fungsi untuk menambah row
  $(document).ready(function(){
  $('#addButId').click(function(){
    var sno=$('#pTable tr').length; //length+1;
    //Menghilangkan tombol tambah data
    trow =  "<tr><td><center>"+sno+"</center></td>"+
            "<td><input type='text' class='form-control' name='nama[]' value='Termin "+sno+"' placeholder='Nama Termin' required></td>"+
            "<td><input type='text' class='form-control' id='bpp"+sno+"' name='bpp[]' placeholder='Total Beasiswa' required></td>"+
            "<td><input type='text' class='form-control' id='pengelolaan"+sno+"' name='pengelolaan[]' placeholder='Total Pengelolaan' required></td>"+
            "<td><input type='text' class='form-control datepicker' id='tanggal"+sno+"' name='tanggal[]' placeholder='Tanggal Tagihan' style='background-color:#fff' required></td>"+
            "<td><input type='text' class='form-control datepicker' id='tanggal_end"+sno+"' name='tanggal_end[]' placeholder='Jatuh Tempo' style='background-color:#fff' required></td>"+
            "<td width='1%'><button data-toggle='tooltip' title='Hapus' type='button' class='btn btn-danger rButton'><span class='fa fa-trash'></span></button></td></tr>";
            $('#pTable').append(trow);
            $('.select').select2();
            $('.datepicker').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true
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

            $("#tanggal"+sno).keydown(function(event){
              return false;
            });

            $("#tanggal_end"+sno).keydown(function(event){
              return false;
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
