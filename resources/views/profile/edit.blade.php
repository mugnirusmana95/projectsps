@extends('index')

@section('title')
  Update Profile
@endsection

@section('content')
<section class="content-header">
  <h1>
    Update Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/profile"> Profile</a></li>
    <li class="active"> Update Profile</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/profile/ubah/simpan" method="post">
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

            <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
              <label for="first_name" class="col-md-2 control-label">First Name <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='first_name' placeholder="First Name" name="first_name" value="{{Auth::user()->name}}">
                @if ($errors->has('first_name'))
                  <span class="help-block">
                    {{$errors->first('first_name')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
              <label for="last_name" class="col-md-2 control-label">Last Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='last_name' placeholder="Last Name" name="last_name" value="{{Auth::user()->l_name}}">
                @if ($errors->has('last_name'))
                  <span class="help-block">
                    {{$errors->first('last_name')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('title_before_name') ? 'has-error' : ''}}">
              <label for="title_before_name" class="col-md-2 control-label">Title Before Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='title_before_name' placeholder="Title Before Name" name="title_before_name" value="{{Auth::user()->tb_name}}">
                @if ($errors->has('title_before_name'))
                  <span class="help-block">
                    {{$errors->first('title_before_name')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('title_after_name') ? 'has-error' : ''}}">
              <label for="title_after_name" class="col-md-2 control-label">Title After Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='title_after_name' placeholder="Title After Name" name="title_after_name" value="{{Auth::user()->ta_name}}">
                @if ($errors->has('title_after_name'))
                  <span class="help-block">
                    {{$errors->first('title_after_name')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('place_of_birthday') ? 'has-error' : ''}}">
              <label for="place_of_birthday" class="col-md-2 control-label">Place of Birthday</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='place_of_birthday' placeholder="Place of Birthday" name="place_of_birthday" value="{{Auth::user()->pob}}">
                @if ($errors->has('place_of_birthday'))
                  <span class="help-block">
                    {{$errors->first('place_of_birthday')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('date_of_birtday') ? 'has-error' : ''}}">
              <label for="date_of_birthday" class="col-md-2 control-label">Date of Birthday</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id='date_of_birthday' placeholder="Date of Birthday" name="date_of_birthday" value="{{Auth::user()->dob}}">
                @if ($errors->has('date_of_birthday'))
                  <span class="help-block">
                    {{$errors->first('date_of_birthday')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="gender" class="col-md-2 control-label">Gender <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="radio" name="gender" value='l' @if (Auth::user()->gender == 'l') {{'checked'}} @endif> Male<br>
                <input type="radio" name="gender" value='p' @if (Auth::user()->gender == 'p') {{'checked'}} @endif> Female
              </div>
            </div>

            <div class="form-group {{$errors->has('address') ? 'has-error' : ''}}">
              <label for="address" class="col-md-2 control-label">Address</label>
              <div class="col-md-8">
                <textarea class="form-control" id='address' name='address' rows="3" placeholder="Address">{{Auth::user()->address}}</textarea>
                @if ($errors->has('address'))
                <span class="help-block">
                    {{$errors->first('address')}}
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
