@extends('index')

@section('title')
  Ubah Pemegang Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Pemegang Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/tagihan"> Tgihan Beasiswa</a></li>
    <li><a href="/tagihan/lihat/{{$id}}"> Detail Tagihan Beasiswa</a></li>
    <li class="active"> Ubah Pemegang Beasiswa</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" action="/tagihan/mahasiswa/ubah/simpan/{{\Crypt::encrypt($colleger->id)}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
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

            <div class="form-group {{$errors->has('nim') ? 'has-error' : ''}}">
              <label for="nim" class="col-md-2 control-label">NIM/NAMA <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nim' placeholder="NIM / NAMA" name="nim" value="{{$colleger->nim_colleger}} {{$colleger->colleger->nama_lengkap}}" readonly style="background-color:#fff">
                @if ($errors->has('nim'))
                <span class="help-block">
                    {{$errors->first('nim')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('chapter1') ? 'has-error' : ''}}">
              <label for="chapter1" class="col-md-2 control-label">Semester Awal Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="chapter1">
                  <option value="1" @if($colleger->chapter1==1)selected @endif>Ganjil</option>
                  <option value="2" @if($colleger->chapter1==2)selected @endif>Genap</option>
                </select>
                @if ($errors->has('chapter1'))
                <span class="help-block">
                    {{$errors->first('chapter1')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('year1') ? 'has-error' : ''}}">
              <label for="year1" class="col-md-2 control-label">Tahun Awal Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='year1' placeholder="Tahun" name="year1" value="{{$colleger->year1}}">
                @if ($errors->has('year1'))
                <span class="help-block">
                    {{$errors->first('year1')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('chapter2') ? 'has-error' : ''}}">
              <label for="chapter2" class="col-md-2 control-label">Semester Akhir Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="chapter2">
                  <option value="1" @if($colleger->chapter2==1)selected @endif>Ganjil</option>
                  <option value="2" @if($colleger->chapter2==2)selected @endif>Genap</option>
                </select>
                @if ($errors->has('chapter2'))
                <span class="help-block">
                    {{$errors->first('chapter2')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('year2') ? 'has-error' : ''}}">
              <label for="year2" class="col-md-2 control-label">Tahun Akhir Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='year2' placeholder="Tahun" name="year2" value="{{$colleger->year2}}">
                @if ($errors->has('year2'))
                <span class="help-block">
                    {{$errors->first('year2')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('chapter3') ? 'has-error' : ''}}">
              <label for="chapter3" class="col-md-2 control-label">Semester Tagihan Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="chapter3">
                  <option value="1" @if($colleger->chapter3==1)selected @endif>Ganjil</option>
                  <option value="2" @if($colleger->chapter3==2)selected @endif>Genap</option>
                </select>
                @if ($errors->has('chapter3'))
                <span class="help-block">
                    {{$errors->first('chapter3')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('year3') ? 'has-error' : ''}}">
              <label for="year3" class="col-md-2 control-label">Tahun Tagihan Beasiswa<span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='year1' placeholder="Tahun" name="year3" value="{{$colleger->year3}}">
                @if ($errors->has('year3'))
                <span class="help-block">
                    {{$errors->first('year3')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('total_chapter') ? 'has-error' : ''}}">
              <label for="total_chapter" class="col-md-2 control-label">Jumlah Semester</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='total_chapter' placeholder="Jumlah Semester" name="total_chapter" value="{{$colleger->total_chapter}}">
                @if ($errors->has('total_chapter'))
                  <span class="help-block">
                    {{$errors->first('total_chapter')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('total_sks') ? 'has-error' : ''}}">
              <label for="total_sks" class="col-md-2 control-label">Jumlah SKS</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='total_sks' placeholder="Jumlah SKS" name="total_sks" value="{{$colleger->total_sks}}">
                @if ($errors->has('total_sks'))
                <span class="help-block">
                    {{$errors->first('total_sks')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
              <label for="bpp" class="col-md-2 control-label">BPP</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='bpp' placeholder="BPP" name="bpp" value="@if($colleger->bpp > 0){{number_format($colleger->bpp,0,'.','.')}}@endif">
                @if ($errors->has('bpp'))
                <span class="help-block">
                    {{$errors->first('bpp')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('pengelolaan') ? 'has-error' : ''}}">
              <label for="pengelolaan" class="col-md-2 control-label">Pengelolaan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='pengelolaan' placeholder="Jumlah Semester" name="pengelolaan" value="@if($colleger->pengelolaan > 0){{number_format($colleger->pengelolaan,0,'.','.')}}@endif">
                @if ($errors->has('pengelolaan'))
                <span class="help-block">
                    {{$errors->first('pengelolaan')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('hidup') ? 'has-error' : ''}}">
              <label for="hidup" class="col-md-2 control-label">Biaya Hidup</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='hidup' placeholder="Biaya Hidup" name="hidup" value="@if($colleger->biaya_hidup > 0){{number_format($colleger->biaya_hidup,0,'.','.')}}@endif">
                @if ($errors->has('hidup'))
                <span class="help-block">
                    {{$errors->first('hidup')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('buku') ? 'has-error' : ''}}">
              <label for="buku" class="col-md-2 control-label">Biaya Buku</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='buku' placeholder="Biaya Buku" name="buku" value="@if($colleger->biaya_buku > 0){{number_format($colleger->biaya_buku,0,'.','.')}}@endif">
                @if ($errors->has('buku'))
                <span class="help-block">
                    {{$errors->first('buku')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('penelitian') ? 'has-error' : ''}}">
              <label for="penelitian" class="col-md-2 control-label">Biaya Penelitian</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='penelitian' placeholder="Biaya Penelitian" name="penelitian" value="@if($colleger->biaya_penelitian > 0){{number_format($colleger->biaya_penelitian,0,'.','.')}}@endif">
                @if ($errors->has('penelitian'))
                <span class="help-block">
                    {{$errors->first('penelitian')}}
                </span>
                @endif
              </div>
            </div>

          </div>

          <div class="box-footer">
            <div class="form-group">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>

</section>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
  var bpp = document.getElementById('bpp');
  bpp.addEventListener('keyup', function(e)
  {
    bpp.value = formatRupiah(this.value);
  });

  var pengelolaan = document.getElementById('pengelolaan');
  pengelolaan.addEventListener('keyup', function(e)
  {
    pengelolaan.value = formatRupiah(this.value);
  });

  var hidup = document.getElementById('hidup');
  hidup.addEventListener('keyup', function(e)
  {
    hidup.value = formatRupiah(this.value);
  });

  var buku = document.getElementById('buku');
  buku.addEventListener('keyup', function(e)
  {
    buku.value = formatRupiah(this.value);
  });

  var penelitian = document.getElementById('penelitian');
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
});
</script>
@endsection
