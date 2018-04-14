@extends('index')

@section('title')
  {{$user->tb_name}} {{$user->name}} {{$user->l_name}} {{$user->ta_name}}
@endsection

@section('content')
<section class="content-header">
  <h1>
    Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Profile</li>
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
          <a href="/profile/foto" class="btn btn-warning btn-md btn-block"><span class="fa fa-edit"><span/> Ubah Profile</a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <b>Data Information</b>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <td width="15%"><b>ID User</b></td>
                  <td width="1%">:</td>
                  <td>{{$user->id}}</td>
                </tr>
                <tr>
                  <td><b>Name</b></td>
                  <td>:</td>
                  <td>{{$user->tb_name}} {{$user->name}} {{$user->l_name}} {{$user->ta_name}}</td>
                </tr>
                <tr>
                  <td><b>Born</b></td>
                  <td>:</td>
                  <td>
                    @if ($user->pob==null && $user->dob==null)
                      <i class="set">No Set</i> / <i class="set">No Set</i>
                    @elseif($user->pob!=null && $user->dob==null)
                      {{$user->pob}} / <i class="set">No Set</i>
                    @elseif($user->pob==null && $user->dob!=null)
                      <i class="set">No Set</i> / {{$user->dob}}
                    @else
                      {{$user->pob}} / {{$user->dob}}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td><b>Gender</b></td>
                  <td>:</td>
                  <td>
                    @if ($user->gender == 'l')
                      Male
                    @else
                      Female
                    @endif
                  </td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td>:</td>
                  <td>
                    @if ($user->address == null)
                      <i class="set">No Set</i>
                    @else
                      {{$user->address}}
                    @endif
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <a href="/profile/ubah" class="btn btn-warning btn-md"><span class="fa fa-edit"><span/> Ubah Biodata</a>
          </div>
        </div>

        <div class="box box-primary">
          <div class="box-header">
            <b>Account Information</b>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <td width="15%"><b>Username</b></td>
                  <td width="1%">:</td>
                  <td>{{$user->username}}</td>
                </tr>
                <tr>
                  <td><b>Email</b></td>
                  <td>:</td>
                  <td>{{$user->email}}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="box-footer">
            <a href="/profile/akun" class="btn btn-warning btn-md"><span class="fa fa-edit"><span/> Ubah Akun</a>
            <a href="/profile/password" class="btn btn-danger btn-md"><span class="fa fa-key"><span/> Ubah Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
