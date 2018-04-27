@extends('index')

@section('title')
  Ubah BPP Prodi
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah BPP Prodi
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/bpp_prodi"> BPP Prodi</a></li>
    <li class="active"> Ubah BPP Prodi</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/master/bpp_prodi/ubah/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">

          <div class="box-body">

            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              {{Session::get('success')}}
            </div>
            @elseif(Session::has('warning'))
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Info!</h4>
              {{Session::get('warning')}}
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

            <div class="form-group {{$errors->has('prodi') ? 'has-error' : ''}}">
              <label for="prodi" class="col-md-2 control-label">Prodi <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="prodi" id="prodi">
                  <option></option>
                  @foreach ($prodi as $key)
                  <option value="{{$key->prodi_id}}" @if($bpp->prodi_id == $key->prodi_id) selected @endif>{{$key->prodi_id}} - @if($key->nama_prodi==null){{'null'}}@else{{$key->nama_prodi}}@endif - {{$key->strata}}</option>
                  @endforeach
                </select>
                @if ($errors->has('prodi'))
                <span class="help-block">
                    {{$errors->first('prodi')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('year') ? 'has-error' : ''}}">
              <label for="year" class="col-md-2 control-label">Tahun SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="year" id="year">
                  @for ($i=$year; $i >= $year2; $i--)
                    <option value="{{$i}}" @if($i == $bpp->year) selected @endif>{{$i}}</option>
                  @endfor
                </select>
                @if ($errors->has('year'))
                <span class="help-block">
                    {{$errors->first('year')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
              <label for="bpp" class="col-md-2 control-label">BPP <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='bpp' placeholder="BPP" name="bpp" value="{{number_format($bpp->bpp,0,'.','.')}}">
                @if ($errors->has('bpp'))
                <span class="help-block">
                    {{$errors->first('bpp')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('sks') ? 'has-error' : ''}}">
              <label for="sks" class="col-md-2 control-label">Maksimal SKS <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='sks' placeholder="Maksimal SKS" name="sks" value="@if($bpp->sks>0){{$bpp->sks}}@else{{'0'}}@endif">
                @if ($errors->has('sks'))
                <span class="help-block">
                    {{$errors->first('sks')}}
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
@include('bppp.script')
@endsection
