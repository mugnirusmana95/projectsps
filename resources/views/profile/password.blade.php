@extends('index')

@section('title')
  Change Password
@endsection

@section('content')
<section class="content-header">
  <h1>
    Update Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/profile"> Profile</a></li>
    <li class="active"> Change Password</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/profile/password/simpan" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="put">
          <div class="box-body">

            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              {{Session::get('success')}}
            </div>
            @elseif(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-close"></i> Success!</h4>
              {{Session::get('error')}}
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

            <div class="form-group {{$errors->has('old_password') ? 'has-error' : ''}}">
              <label for="old_password" class="col-md-2 control-label">Old Password <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="password" class="form-control" id='old_password' placeholder="Old Password" name="old_password" value="{{ old('old_password') }}">
                @if ($errors->has('old_password'))
                  <span class="help-block">
                    {{$errors->first('old_password')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
              <label for="password" class="col-md-2 control-label">New Password <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="password" class="form-control" id='password' placeholder="New Password" name="password" value="{{ old('password') }}">
                @if ($errors->has('password'))
                  <span class="help-block">
                    {{$errors->first('password')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
              <label for="password_confirm" class="col-md-2 control-label">Retype New Password <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="password" class="form-control" id='password_confirm' placeholder="Retype New Password" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    {{$errors->first('password_confirmation')}}
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
                <button type="submit" class="btn btn-info">Save</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
@endsection
