@extends('index')

@section('title')
  {{$user->name}} {{$user->l_name}}
@endsection

@section('content')
<section class="content-header">
  <h1>
    {{$user->name}} {{$user->l_name}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/users"> Manajemen User</a></li>
    <li class="active"> {{$user->name}} {{$user->l_name}}</li>
  </ol>
</section>

@if(Session::has('success'))
<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{Session::get('success')}}
      </div>
    </div>
  </div>
</section>
@endif

<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
          @if ($user->profile == null && $user->gender == null)
            <img class="profile-user-img img-responsive" src="{{Storage::url('profile/default.png')}}" alt="User profile picture">
          @elseif ($user->profile == null && $user->gender == 'l')
            <img class="profile-user-img img-responsive" src="{{Storage::url('profile/male.png')}}" alt="User profile picture">
          @elseif ($user->profile == null && $user->gender == 'p')
            <img class="profile-user-img img-responsive" src="{{Storage::url('profile/female.png')}}" alt="User profile picture">
          @else
            <img class="profile-user-img img-responsive" src="{{Storage::url('profile/'.$user->id.'/'.$user->profile)}}" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">{{$user->tb_name}} {{$user->name}} {{$user->l_name}} {{$user->ta_name}}</h3>
          <p class="text-muted text-center">
            @if ($user->level == 0)
              Developer
            @elseif($user->level == 1)
              Administrator
            @else
              User
            @endif
          </p>
          <div class="col-md-6">
            <a href="/users/ubah/{{$user->id}}" class="btn btn-warning btn-block" data-toggle="tooltip" title="Update Level User"><span class="fa fa-edit"></span></a>
          </div>
          <div class="col-md-6" style="margin-top:3px">
            <a href="/users/reset/{{$user->id}}" class="btn btn-danger btn-block" data-toggle="tooltip" title="Reset Password"><span class="fa fa-key"></span></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-hover">
            <tr>
              <td width="15%">NIP</td>
              <td width="1%">:</td>
              <td>{{$user->nip}}</td>
            </tr>
            <tr>
              <td>Nama Lengkap</td>
              <td>:</td>
              <td>{{$user->tb_name}} {{$user->name}} {{$user->l_name}} {{$user->ta_name}}</td>
            </tr>
            <tr>
              <td>Username</td>
              <td>:</td>
              <td>{{$user->username}}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>{{$user->email}}</td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:</td>
              <td>
                @if ($user->gender == 'l')
                  Pria
                @else
                  Wanita
                @endif
              </td>
            </tr>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
