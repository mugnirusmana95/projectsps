@extends('index')

@section('title')
  Ubah Termin (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Termin (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/beasiswa"> Beasiswa (SPK)</a></li>
    <li><a href="/beasiswa/lihat/{{$id}}"> Detail Beasiswa (SPK)</a></li>
    <li class="active"> Ubah Termin (SPK)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" action="/beasiswa/termin/ubah/simpan/{{\Crypt::encrypt($termin->id)}}" method="post">
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

            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
              <label for="name" class="col-md-2 control-label">Nama Termin <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nim' placeholder="Nama Termin" name="name" value="{{$termin->name}}">
                @if ($errors->has('name'))
                <span class="help-block">
                    {{$errors->first('name')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
              <label for="bpp" class="col-md-2 control-label">BPP <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='bpp' placeholder="BPP" name="bpp" value="{{number_format($termin->bpp,0,'.','.')}}">
                @if ($errors->has('bpp'))
                <span class="help-block">
                    {{$errors->first('bpp')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('pengelolaan') ? 'has-error' : ''}}">
              <label for="pengelolaan" class="col-md-2 control-label">Pengelolaan <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='pengelolaan' placeholder="Jumlah Semester" name="pengelolaan" value="{{number_format($termin->pengelolaan,0,'.','.')}}">
                @if ($errors->has('pengelolaan'))
                <span class="help-block">
                    {{$errors->first('pengelolaan')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
              <label for="date" class="col-md-2 control-label">Tanggal Tagihan <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" id='date' placeholder="yyyy-mm-dd" name="date" value="{{$termin->date}}" readonly style="background-color:#fff">
                @if ($errors->has('date'))
                <span class="help-block">
                    {{$errors->first('date')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('date_end') ? 'has-error' : ''}}">
              <label for="date_end" class="col-md-2 control-label">Jatuh Tempo <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" id='date_end' placeholder="yyyy-mm-dd" name="date_end" value="{{$termin->date_end}}" readonly style="background-color:#fff">
                @if ($errors->has('date_end'))
                <span class="help-block">
                    {{$errors->first('date_end')}}
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
