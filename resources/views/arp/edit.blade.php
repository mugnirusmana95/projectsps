@extends('index')

@section('title')
  Ubah Beasiswa BPP Telah Di ITB (SP2D)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Beasiswa BPP Telah Di ITB (SP2D)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/pembayaran"> Beasiswa BPP BPP Telah Di ITB (SP2D)</a></li>
    <li class="active"> Ubah Beasiswa BPP BPP Telah Di ITB (SP2D)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/pembayaran/ubah/simpan/{{$id}}" method="post">
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

            <div class="form-group {{$errors->has('invoice') ? 'has-error' : ''}}">
              <label for="invoice" class="col-md-2 control-label">No Invoice<span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="invoice" id="invoice">
                  @foreach ($ar as $key)
                  <option value="{{$key->id}}" @if($key->id==$arp->id_ar)selected @endif>{{$key->invoice}}</option>
                  @endforeach
                </select>
                @if ($errors->has('invoice'))
                <span class="help-block">
                    {{$errors->first('invoice')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('sp2d') ? 'has-error' : ''}}">
              <label for="sp2d" class="col-md-2 control-label">No SP2D2<span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='sp2d' placeholder="No SP2D" name="sp2d" value="{{$arp->no_payment}}" style="background-color:#fff" readonly>
                @if ($errors->has('sp2d'))
                <span class="help-block">
                    {{$errors->first('sp2d')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('ref_sp2d') ? 'has-error' : ''}}">
              <label for="ref_sp2d" class="col-md-2 control-label">No. Ref. SP2D <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='ref_sp2d' placeholder="No Referensi SP2D" name="ref_sp2d" value="{{$arp->ref_sp2d}}">
                @if ($errors->has('ref_sp2d'))
                <span class="help-block">
                    {{$errors->first('ref_sp2d')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('tgl') ? 'has-error' : ''}}">
              <label for="tgl" class="col-md-2 control-label">Tanggal Diterima <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" id='tgl' placeholder="yyyy-mm-dd" name="tgl" value="{{$arp->date_sp2d}}" readonly style="background-color: #fff">
                @if ($errors->has('tgl'))
                <span class="help-block">
                    {{$errors->first('tgl')}}
                </span>
                @endif
              </div>
            </div>

            <div class="" id="dis">

              <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
                <label for="termin" class="col-md-2 control-label">Termin <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='termin' placeholder="Termin" name="termin" value="{{$arp->termin}}" readonly style="background-color:#fff">
                  @if ($errors->has('termin'))
                  <span class="help-block">
                      {{$errors->first('termin')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('tgl_tagihan') ? 'has-error' : ''}}">
                <label for="tgl_tagihan" class="col-md-2 control-label">Tanggal Tagihan</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tgl_tagihan' placeholder="yyyy-mm-dd" name="tgl_tagihan" value="{{$arp->date}}" readonly style="background-color: #fff">
                  @if ($errors->has('tgl_tagihan'))
                  <span class="help-block">
                      {{$errors->first('tgl_tagihan')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('tgl_tempo') ? 'has-error' : ''}}">
                <label for="tgl_tempo" class="col-md-2 control-label">Jatuh Tempo</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tgl_tempo' placeholder="yyyy-mm-dd" name="tgl_tempo" value="{{$arp->date_end}}" readonly style="background-color: #fff">
                  @if ($errors->has('tgl_tempo'))
                  <span class="help-block">
                      {{$errors->first('tgl_tempo')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
                <label for="bpp" class="col-md-2 control-label">Total BPP</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='bpp' placeholder="Total BPP" name="bpp" value="{{number_format($arp->bpp,0,'.','.')}}">
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
                  <input type="text" class="form-control" id='pengelolaan' placeholder="Biaya Pengelolaan" name="pengelolaan" value="{{number_format($arp->pengelolaan,0,'.','.')}}">
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
                  <input type="text" class="form-control" id='tagihan' placeholder="Total Tagihan" name="tagihan" value="{{number_format($arp->tagihan,0,'.','.')}}">
                  @if ($errors->has('tagihan'))
                  <span class="help-block">
                      {{$errors->first('tagihan')}}
                  </span>
                  @endif
                </div>
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
    $("#invoice").change(function(){
      var val = $(this).val();

      $.get( "/pembayaran/tagihan/search/"+val, function( value ) {
        $('#termin').val(value.tagihan.termin)
        $('#tgl_tagihan').val(value.tagihan.date)
        $('#tgl_tempo').val(value.tagihan.date_end)
        $('#tagihan').val(value.tagihan.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#pengelolaan').val(value.tagihan.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#bpp').val(value.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
      });

      $.get( "/pembayaran/id/search/"+val, function( value2 ) {
        $('#sp2d').val(value2)
      });
    });

    var bpp = document.getElementById('bpp');
    bpp.addEventListener('keyup', function(e)
    {
      bpp.value = formatRupiah(this.value);
    });

    var tagihan = document.getElementById('tagihan');
    tagihan.addEventListener('keyup', function(e)
    {
      tagihan.value = formatRupiah(this.value);
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
