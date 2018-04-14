@extends('index')

@section('title')
  Ubah Sumber Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Sumber Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/sumber_beasiswa"> Sumber Beasiswa</a></li>
    <li class="active"> Ubah Sumber Beasiswa</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/master/sumber_beasiswa/ubah/simpan/{{$id}}" method="post">
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

            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
              <label for="name" class="col-md-2 control-label">Jenis Beasiswa <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='name' placeholder="Jenis Beasiswa" name="name" value="{{$source->name}}">
                @if ($errors->has('name'))
                <span class="help-block">
                    {{$errors->first('name')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('bpp') ? 'has-error' : ''}}">
              <label for="name" class="col-md-2 control-label">Dana Pengelolaan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='bpp' placeholder="Jenis Beasiswa" name="bpp" value="{{number_format($source->bpp,0,'.','.')}}">
                @if ($errors->has('bpp'))
                <span class="help-block">
                    {{$errors->first('bpp')}}
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
@include('source.script')
@endsection
