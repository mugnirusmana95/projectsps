@extends('index')

@section('title')
  Tambah Beasiswa BPP Telah Di ITB (SP2D)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Beasiswa BPP Telah Di ITB (SP2D)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/pembayaran"> Beasiswa BPP BPP Telah Di ITB (SP2D)</a></li>
    <li class="active"> Tambah Beasiswa BPP BPP Telah Di ITB (SP2D)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/pembayaran/tambah/simpan" method="post">
          {{ csrf_field() }}
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
              <label for="invoice" class="col-md-2 control-label">No Invoice <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="invoice" id="invoice">
                  <option value=""></option>
                  @foreach ($ar as $key)
                  <option value="{{$key->id}}">{{$key->invoice}}</option>
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
                <input type="text" class="form-control" id='sp2d' placeholder="No SP2D" name="sp2d" value="{{old('sp2d')}}" style="background-color:#fff" readonly>
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
                <input type="text" class="form-control" id='ref_sp2d' placeholder="No Referensi SP2D" name="ref_sp2d" value="{{old('ref_sp2d')}}">
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
                <input type="text" class="form-control datepicker" id='tgl' placeholder="yyyy-mm-dd" name="tgl" value="{{old('tgl')}}" readonly style="background-color: #fff">
                @if ($errors->has('tgl'))
                <span class="help-block">
                    {{$errors->first('tgl')}}
                </span>
                @endif
              </div>
            </div>

            <div class="hide" id="dis">

              <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
                <label for="termin" class="col-md-2 control-label">Termin <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='termin' placeholder="Termin" name="termin" value="{{old('termin')}}" readonly style="background-color:#fff">
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
                  <input type="text" class="form-control" id='tgl_tagihan' placeholder="yyyy-mm-dd" name="tgl_tagihan" value="{{old('tgl_tagihan')}}" readonly style="background-color: #fff">
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
                  <input type="text" class="form-control" id='tgl_tempo' placeholder="yyyy-mm-dd" name="tgl_tempo" value="{{old('tgl_tempo')}}" readonly style="background-color: #fff">
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
                  <input type="text" class="form-control" id='bpp' placeholder="Total BPP" name="bpp" value="{{old('bpp')}}">
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
                  <input type="text" class="form-control" id='pengelolaan' placeholder="Biaya Pengelolaan" name="pengelolaan" value="{{old('pengelolaan')}}">
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
                  <input type="text" class="form-control" id='tagihan' placeholder="Total Tagihan" name="tagihan" value="{{old('tagihan')}}">
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
@include('arp.script')
@endsection
