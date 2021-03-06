@extends('index')

@section('title')
  Ubah Hak Akses
@endsection

@section('content')
<section class="content-header">
  <h1>
    Ubah Hak Akses
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/users"> Manajemen User</a></li>
    <li class="active"> Ubah Hak Akses</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/users/ubah/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">
          <div class="box-body">

            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              {{Session::get('success')}}
            </div>
            @else
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info-circle"></i> Info!</h4>
              Field dengan tanda (<span class="req">*</span>) wajib diisi.
            </div>
            @endif

            <div class="form-group">
              <label for="first_name" class="col-md-2 control-label">Nama Depan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='first_name' placeholder="First Name" name="first_name" value="{{$user->tb_name}} {{$user->name}} {{$user->l_name}} {{$user->ta_name}}" readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="level" class="col-md-2 control-label">Hak Akses <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control" name="level" id='level'>
                  <option value="2" @if ($user->level == '2') {{ 'selected' }}  @endif>User</option>
                  <option value="1" @if ($user->level == '1') {{ 'selected' }}  @endif>Administrator</option>
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
