@extends('index')

@section('title')
  Manajemen User
@endsection

@section('content')
<section class="content-header">
  <h1>
    Manajemen User
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Manajemen User</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <a href="/users/tambah" class="btn btn-md btn-info">Tambah Akun</a>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        @if(Session::has('success'))
        <div class="box-header">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{Session::get('success')}}
          </div>
        </div>
        @elseif(Session::has('error'))
        <div class="box-header">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-close"></i> Error!</h4>
            {{Session::get('error')}}
          </div>
        </div>
        @endif
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th width="15%"><center>NIP</center></th>
                  <th>Nama Lengkap</th>
                  <th width="10%">Username</th>
                  <th width="20%">Email</th>
                  <th width="15%"><center>Hak Akses</center></th>
                  <th width="15%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($user as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->nip}}</center></td>
                  <td>{{$key->tb_name}} {{$key->name}} {{$key->l_name}} {{$key->ta_name}}</td>
                  <td>{{$key->username}}</td>
                  <td>{{$key->email}}</td>
                  <td>
                    <center>
                      @if ($key->level == 0)
                        <span class="label label-danger">Developer</span>
                      @elseif($key->level == 1)
                        <span class="label label-primary">Administrator</span>
                      @else
                        <span class="label label-info">User</span>
                      @endif
                    </center>
                  </td>
                  <td align='left'>
                      <a href="/users/detail/{{crypt::encrypt($key->id)}}" class="btn btn-md btn-primary" data-toggle="tooltip" title="Lihat Data"><span class="fa fa-eye"></span></a>
                      <a href="/users/ubah/{{crypt::encrypt($key->id)}}" class="btn btn-md btn-warning" data-toggle="tooltip" title="Ubah Hak Akses"><span class="fa fa-edit"></span></a>
                      <a href="/users/reset/{{crypt::encrypt($key->id)}}" class="btn btn-md btn-danger" data-toggle="tooltip" title="Reset Password"><span class="fa fa-key"></span></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
