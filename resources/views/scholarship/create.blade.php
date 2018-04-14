@extends('index')

@section('title')
  Tambah Beasiswa (SPK)
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Beasiswa (SPK)
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/beasiswa"> Beasiswa (SPK)</a></li>
    <li class="active"> Tambah Beasiswa (SPK)</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/beasiswa/tambah/simpan" method="post">
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

            <div class="form-group {{$errors->has('spk') ? 'has-error' : ''}}">
              <label for="spk" class="col-md-2 control-label">No. SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='spk' placeholder="No. SPK" name="spk" value="{{old('spk')}}">
                @if ($errors->has('spk'))
                <span class="help-block">
                    {{$errors->first('spk')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
              <label for="year" class="col-md-2 control-label">Tahun SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="year" id="year">
                  <option value=""></option>
                  @for ($i=$year; $i >= $year2; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
                @if ($errors->has('year'))
                <span class="help-block">
                    {{$errors->first('year')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('source') ? 'has-error' : ''}}">
              <label for="source" class="col-md-2 control-label">Sumber Beasiswa <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="source" id="source">
                  <option value=""></option>
                  @foreach ($source as $key)
                  <option value="{{$key->name}}">{{$key->name}}</option>
                  @endforeach
                  <option value="0">Lainnya (Tambah)</option>
                </select>
                @if ($errors->has('source'))
                <span class="help-block">
                    {{$errors->first('source')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="type" class="col-md-2 control-label">Jenis Beasiswa</label>
              <div class="col-md-8">
                <select class="form-control select" name="type" id="type">
                  <option value=""></option>
                  @foreach ($type as $key)
                  <option value="{{$key->name}}">{{$key->name}}</option>
                  @endforeach
                  <option value="0">Lainnya (Tambah)</option>
                </select>
              </div>
            </div>

            <div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
              <label for="nilai" class="col-md-2 control-label">Total Beasiswa <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nilai' placeholder="Total Beasiswa" name="nilai" value="{{old('nilai')}}">
                @if ($errors->has('nilai'))
                <span class="help-block">
                    {{$errors->first('nilai')}}
                </span>
                @endif
              </div>
            </div>

            <input type="hidden" class="form-control" id='bpp' placeholder="Total Beasiswa" name="bpp" value="{{old('bpp')}}">

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
