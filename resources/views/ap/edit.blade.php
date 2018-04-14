@extends('index')

@section('title')
  Ubah Beasiswa BPP Dibayar Ke ITB
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Beasiswa BPP Dibayar Ke ITB
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/penagihan"> Beasiswa BPP Dibayar Ke ITB</a></li>
    <li class="active"> Ubah Beasiswa BPP Dibayar Ke ITB</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/penagihan/ubah/simpan/{{$id}}" method="post">
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

            <div class="form-group {{$errors->has('id') ? 'has-error' : ''}}">
              <label for="id" class="col-md-2 control-label">No BPP <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='id' placeholder="Nomor BPP" name="id" value="{{$ap->no_pay}}">
                @if ($errors->has('id'))
                <span class="help-block">
                    {{$errors->first('id')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('sp2d') ? 'has-error' : ''}}">
              <label for="sp2d" class="col-md-2 control-label">No Payment BPP Telah Di ITB (SP2D) <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="sp2d" id="sp2d">
                  @foreach ($arp as $key)
                  <option value="{{$key->id}}" @if($key->id==$ap->id_arp)selected @endif>{{$key->no_payment}}</option>
                  @endforeach
                </select>
                @if ($errors->has('sp2d'))
                <span class="help-block">
                    {{$errors->first('sp2d')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('tgl') ? 'has-error' : ''}}">
              <label for="tgl" class="col-md-2 control-label">Tanggal Dibayar <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" id='tgl' placeholder="yyyy-mm-dd" name="tgl" value="{{$ap->date_payable}}" readonly style="background-color: #fff">
                @if ($errors->has('tgl'))
                <span class="help-block">
                    {{$errors->first('tgl')}}
                </span>
                @endif
              </div>
            </div>

            <div class="" id="dis">

              <div class="form-group {{$errors->has('invoice') ? 'has-error' : ''}}">
                <label for="invoice" class="col-md-2 control-label">Invoice</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='invoice' placeholder="Invoice" name="invoice" value="{{$ap->invoice}}" readonly style="background-color: #fff">
                  @if ($errors->has('invoice'))
                  <span class="help-block">
                      {{$errors->first('invoice')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
                <label for="termin" class="col-md-2 control-label">Termin</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='termin' placeholder="Termin" name="termin" value="{{$ap->termin}}" readonly style="background-color: #fff">
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
                  <input type="text" class="form-control" id='tgl_tagihan' placeholder="yyyy-mm-dd" name="tgl_tagihan" value="{{$ap->date}}" readonly style="background-color: #fff">
                  @if ($errors->has('tgl_tagihan'))
                  <span class="help-block">
                      {{$errors->first('tgl_tagihan')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('tgl_tempo') ? 'has-error' : ''}}">
                <label for="tgl_tempo" class="col-md-2 control-label">Jatuh Tempo Tagihan</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tgl_tempo' placeholder="yyyy-mm-dd" name="tgl_tempo" value="{{$ap->date_end}}" readonly style="background-color: #fff">
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
                  <input type="text" class="form-control" id='bpp' placeholder="Total BPP" name="bpp" value="{{number_format($ap->bpp,0,'.','.')}}">
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
                  <input type="text" class="form-control" id='pengelolaan' placeholder="Biaya Pengelolaan" name="pengelolaan" value="{{number_format($ap->pengelolaan,0,'.','.')}}">
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
                  <input type="text" class="form-control" id='tagihan' placeholder="Total Tagihan" name="tagihan" value="{{number_format($ap->tagihan,0,'.','.')}}">
                  @if ($errors->has('tagihan'))
                  <span class="help-block">
                      {{$errors->first('tagihan')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('itb') ? 'has-error' : ''}}">
                <label for="itb" class="col-md-2 control-label">Setoran Ke ITB</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='itb' placeholder="Setoran Ke ITB" name="itb" value="{{number_format($ap->bpp,0,'.','.')}}" readonly style="background-color:#fff">
                  @if ($errors->has('itb'))
                  <span class="help-block">
                      {{$errors->first('itb')}}
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
    $("#bpp").change(function(){
      $("#itb").val($("#bpp").val());
    });

    $("#sp2d").change(function(){
      var val = $(this).val();

      //Menampilkan total dari termin
      $.get( "/penagihan/total/search/"+val, function( value ) {
        $('#invoice').val(value.tagihan.invoice)
        $('#termin').val(value.arp.termin)
        $('#tgl_tagihan').val(value.arp.date)
        $('#tgl_tempo').val(value.arp.date_end)
        $('#tagihan').val(value.arp.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#pengelolaan').val(value.arp.pengelolaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#bpp').val(value.bpp.bpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
        $('#itb').val($('#bpp').val())
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
