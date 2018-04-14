@extends('index')

@section('title')
  Tambah Akun
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Akun
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/users"> Manajemen User</a></li>
    <li class="active"> Tambah Akun</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/users/tambah/simpan" method="post">
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

            <div class="form-group {{$errors->has('nip') ? 'has-error' : ''}}">
              <label for="nip" class="col-md-2 control-label">NIP <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nip' placeholder="NIP" name="nip" value="{{old('nip')}}">
                @if ($errors->has('nip'))
                <span class="help-block">
                    {{$errors->first('nip')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
              <label for="nama_depan" class="col-md-2 control-label">Nama Depan <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nama_depan' placeholder="Nama Depan" name="nama_depan" value="{{old('nama_depan')}}">
                @if ($errors->has('nama_depan'))
                <span class="help-block">
                    {{$errors->first('nama_depan')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
              <label for="nama_belakang" class="col-md-2 control-label">Nama Belakang</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='nama_belakang' placeholder="Nama Belakang" name="nama_belakang" value="{{old('nama_belakang')}}">
                @if ($errors->has('nama_belakang'))
                <span class="help-block">
                    {{$errors->first('nama_belakang')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
              <label for="username" class="col-md-2 control-label">Username <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='username' placeholder="Username" name="username" value="{{old('username')}}">
                @if ($errors->has('username'))
                <span class="help-block">
                    {{$errors->first('username')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
              <label for="email" class="col-md-2 control-label">Email <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="email" class="form-control" id='email' placeholder="Email" name="email" value="{{old('email')}}">
                @if ($errors->has('email'))
                <span class="help-block">
                    {{$errors->first('email')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="gender" class="col-md-2 control-label">Jenis Kelamin <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="radio" name="jenis_kelamin" value='l' checked> Pria<br>
                <input type="radio" name="jenis_kelamin" value='p'> Wanita
              </div>
            </div>

            <div class="form-group">
              <label for="user_level" class="col-md-2 control-label">Hak Akses <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="user_level" id='user_level'>
                  <option value="2">User</option>
                  <option value="1">Administrator</option>
                </select>
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
