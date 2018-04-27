@extends('index')

@section('title')
  Tambah Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/tagihan"> Tagihan Beasiswa</a></li>
    <li class="active"> Tambah Beasiswa</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/tagihan/tambah/simpan" method="post">
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
              Field dengan tanda (<span class="req">*</span>) wajib diisi.
            </div>
            @endif

            <div class="form-group {{$errors->has('spk') ? 'has-error' : ''}}">
              <label for="spk" class="col-md-2 control-label">No SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="spk" id="spk">
                  <option value=""></option>
                  @foreach ($scholarship as $key)
                  <option value="{{$key->id}}">{{$key->spk}} - {{$key->source}} - {{$key->year}}</option>
                  @endforeach
                </select>
                @if ($errors->has('spk'))
                <span class="help-block">
                    {{$errors->first('spk')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('invoice') ? 'has-error' : ''}}">
              <label for="invoice" class="col-md-2 control-label">No Invoice <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='invoice' placeholder="Nomor Invoice" name="invoice" value="{{old('invoice')}}" readonly style="background-color:#FFF">
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
                <select class="form-control select" name="termin" id='termin'>
                  <option value=""></option>
                </select>
                @if ($errors->has('termin'))
                <span class="help-block">
                    {{$errors->first('termin')}}
                </span>
                @endif
              </div>
            </div>

            <div class="hide" id="dis">

              <input type="hidden" id='termin2' placeholder="Termin2" name="termin2">
              <input type="hidden" id='termin3' placeholder="Termin3" name="termin3">

              <div class="form-group {{$errors->has('tgl') ? 'has-error' : ''}}">
                <label for="tgl" class="col-md-2 control-label">Tanggal Tagihan <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tgl' placeholder="yyyy-mm-dd" name="tgl" value="{{old('tgl')}}" readonly style="background-color: #fff">
                  @if ($errors->has('tgl'))
                  <span class="help-block">
                      {{$errors->first('tgl')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('tempo') ? 'has-error' : ''}}">
                <label for="tempo" class="col-md-2 control-label">Jatuh Tempo <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tempo' placeholder="yyyy-mm-dd" name="tempo" value="{{old('tempo')}}" readonly style="background-color: #fff">
                  @if ($errors->has('tempo'))
                  <span class="help-block">
                      {{$errors->first('tempo')}}
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
@include('ar.script')
@endsection
