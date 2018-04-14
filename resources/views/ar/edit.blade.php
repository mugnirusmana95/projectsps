@extends('index')

@section('title')
  Ubah Tagihan Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Tagihan Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/tagihan"> Tagihan Beasiswa</a></li>
    <li class="active"> Ubah Tagihan Beasiswa</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/tagihan/ubah/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">

          <div class="box-body">

            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              {{Session::get('success')}}
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
              Field dengan field (<span class="req">*</span>) wajib diisi.
            </div>
            @endif

            <div class="form-group {{$errors->has('spk') ? 'has-error' : ''}}">
              <label for="spk" class="col-md-2 control-label">No SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='spk' placeholder="No SPK" name="spk" value="{{$ar->scholarship->spk}}" readonly>
                @if ($errors->has('spk'))
                <span class="help-block">
                    {{$errors->first('invspkoice')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('invoice') ? 'has-error' : ''}}">
              <label for="invoice" class="col-md-2 control-label">No Invoice <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='invoice' placeholder="No Invoice" name="invoice" value="{{$ar->invoice}}" readonly>
                @if ($errors->has('invoice'))
                <span class="help-block">
                    {{$errors->first('invoice')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
              <label for="termin" class="col-md-2 control-label">Termin <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="termin" id=termin>
                  @foreach ($termin as $key)
                  <option value="{{$key->id}}" @if($key->id==$ar->id_termin)selected @endif>{{$key->name}}</option>
                  @endforeach
                </select>
                @if ($errors->has('termin'))
                <span class="help-block">
                    {{$errors->first('termin')}}
                </span>
                @endif
                <input type="hidden" class="form-control" name="termin2" id="termin2" value="{{$ar->termin}}">
                <input type="hidden" class="form-control" name="termin3" id="termin3" value="{{$ar->id_termin}}">
              </div>
            </div>

            <div class="form-group {{$errors->has('date') ? 'has-error' : ''}}">
              <label for="date" class="col-md-2 control-label">Tanggal Tagihan <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" id='date' placeholder="No Invoice" name="date" value="{{$ar->date}}" readonly style="background-color:#fff">
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
                <input type="text" class="form-control datepicker" id='date_end' placeholder="No Invoice" name="date_end" value="{{$ar->date_end}}" readonly style="background-color:#fff">
                @if ($errors->has('date_end'))
                <span class="help-block">
                    {{$errors->first('date_end')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
              <label for="bpp" class="col-md-2 control-label">Total BPP</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='bpp' placeholder="Total BPP" name="bpp" value="{{number_format($ar->bpp,0,'.','.')}}">
                @if ($errors->has('bpp'))
                <span class="help-block">
                    {{$errors->first('bpp')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('pengelolaan') ? 'has-error' : ''}}">
              <label for="pengelolaan" class="col-md-2 control-label">Total Pengelolaan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='pengelolaan' placeholder="Total Pengelolaan" name="pengelolaan" value="{{number_format($ar->pengelolaan,0,'.','.')}}">
                @if ($errors->has('pengelolaan'))
                <span class="help-block">
                    {{$errors->first('pengelolaan')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('tagihan') ? 'has-error' : ''}}">
              <label for="tagihan" class="col-md-2 control-label">Total Tagihan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='tagihan' placeholder="Total Tagihan" name="tagihan" value="{{number_format($ar->tagihan,0,'.','.')}}">
                @if ($errors->has('tagihan'))
                <span class="help-block">
                    {{$errors->first('tagihan')}}
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

        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#termin").change(function(){
      var val2 = $(this).val();
      $.get( "/tagihan/total/search/"+val2, function( value ) {
        $('#termin').val(value.tagihan.name)
        $('#termin2').val(value.tagihan.name)
        $('#termin3').val(value.tagihan.id)
        $('#tagihan').val(value.tagihan.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#pengelolaan').val(value.tagihan.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#date').val(value.tagihan.date)
        $('#date_end').val(value.tagihan.date_end)
        $('#bpp').val(value.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      });
    });
    var pengelolaan = document.getElementById('pengelolaan');
    pengelolaan.addEventListener('keyup', function(e)
    {
      pengelolaan.value = formatRupiah(this.value);
    });

    var tagihan = document.getElementById('tagihan');
    tagihan.addEventListener('keyup', function(e)
    {
      tagihan.value = formatRupiah(this.value);
    });

    var bpp = document.getElementById('bpp');
    bpp.addEventListener('keyup', function(e)
    {
      bpp.value = formatRupiah(this.value);
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
