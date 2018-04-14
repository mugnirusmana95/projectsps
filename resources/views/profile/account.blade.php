@extends('index')

@section('title')
  Update Acount
@endsection

@section('content')
<section class="content-header">
  <h1>
    Update Acount
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/profile"> Profile</a></li>
    <li class="active"> Update Acount</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/profile/akun/simpan" method="post">
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
              The data failed to be saved to the database.
            </div>
            @else
            <div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info-circle"></i> Info!</h4>
              Field with (<span class="req">*</span>) is required.
            </div>
            @endif

            <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
              <label for="username" class="col-md-2 control-label">Username <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='username' placeholder="Username" name="username" value="{{Auth::user()->username}}">
                @if ($errors->has('username'))
                  <span class="help-block">
                    {{$errors->first('username')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
              <label for="email" class="col-md-2 control-label">Last Name</label>
              <div class="col-md-8">
                <input type="email" class="form-control" id='email' placeholder="Email" name="email" value="{{Auth::user()->email}}">
                @if ($errors->has('email'))
                  <span class="help-block">
                    {{$errors->first('email')}}
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
