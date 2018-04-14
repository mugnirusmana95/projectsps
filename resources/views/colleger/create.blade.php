@extends('index')

@section('title')
  Tambah Mahasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Mahasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/mahasiswa"> Mahasiswa</a></li>
    <li class="active"> Tambah Mahasiswa</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/master/mahasiswa/tambah/simpan" method="post">
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
              The data failed to be saved to the database.
            </div>
            @else
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info-circle"></i> Info!</h4>
              Field with (<span class="req">*</span>) is required.
            </div>
            @endif

            <div class="form-group {{$errors->has('nim') ? 'has-error' : ''}}">
              <label for="nim" class="col-md-2 control-label">NIM <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nim' placeholder="NIM" name="nim" value="{{old('nim')}}">
                @if ($errors->has('nim'))
                <span class="help-block">
                    {{$errors->first('nim')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
              <label for="nama" class="col-md-2 control-label">Nama <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='name' placeholder="Nama" name="nama" value="{{old('nama')}}">
                @if ($errors->has('nama'))
                <span class="help-block">
                    {{$errors->first('nama')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('semester') ? 'has-error' : ''}}">
              <label for="chapter" class="col-md-2 control-label">Semester</label>
              <div class="col-md-8">
                <select class="form-control" id="semester" name="semester">
                  <option value=""></option>
                  <option value="1">Ganjil (GJ)</option>
                  <option value="2">Genap (GN)</option>
                </select>
              </div>
            </div>

            <div class="form-group {{$errors->has('program') ? 'has-error' : ''}}">
              <label for="program" class="col-md-2 control-label">Program <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" id="program" name="program">
                  <option value=""></option>
                  <option value="1">Magister</option>
                  <option value="2">Doctor</option>
                </select>
                @if ($errors->has('program'))
                <span class="help-block">
                    {{$errors->first('program')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('fakultas') ? 'has-error' : ''}}">
              <label for="fakultas" class="col-md-2 control-label">Fakultas <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" id="fakultas" name="fakultas">
                  <option value=""></option>
                  @foreach ($faculty as $key)
                  <option value="{{$key->name}}">{{$key->name}}</option>
                  @endforeach
                  <option value="0">Lainnya (Tambah)</option>
                </select>
                @if ($errors->has('fakultas'))
                <span class="help-block">
                    {{$errors->first('fakultas')}}
                </span>
                @endif

              </div>
            </div>

            <div class="form-group fakultas-invalid">
              <label for="fakultas2" class="col-md-2 control-label">Fakultas Lainnya <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" name="fakultas2" value="" class="form-control" id='fakultas2' >
              </div>
            </div>

            <div class="form-group {{$errors->has('prodi') ? 'has-error' : ''}}">
              <label for="prodi" class="col-md-2 control-label">Program Studi <span class="req">*</span></label>
              <div class="col-md-8 valid">
                <select class="form-control" id="prodi" name="prodi">
                  <option value=""></option>
                  <option value="0">Lainnya (Tambah)</option>
                </select>
                @if ($errors->has('prodi'))
                  <span class="help-block">
                    {{$errors->first('prodi')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group prodi-invalid">
              <label for="prodi" class="col-md-2 control-label">Program Studi Lainnya<span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" name="prodi2" value="" class="form-control" id='prodi2' >
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
@include('colleger.script')
@endsection
