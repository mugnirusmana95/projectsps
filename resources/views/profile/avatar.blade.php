@extends('index')

@section('title')
  Update Avatar
@endsection

@section('content')
<section class="content-header">
  <h1>
    Update Avatar
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/profile"> Profile</a></li>
    <li class="active"> Update Avatar</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/profile/foto/simpan" method="post" enctype="multipart/form-data">
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

            <div class="form-group {{$errors->has('file') ? 'has-error' : ''}}">
              <label for="file" class="col-md-2 control-label">File <span class="req">*</span></label>
              <div class="col-md-8">
                <input type="file" id='file' placeholder="Avatar" name="file" accept="image/*">
                @if ($errors->has('file'))
                  <span class="help-block">
                    {{$errors->first('file')}}
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-md-2 control-label"></label>
              <div class="col-md-8">
                <img id="show" src="{{Storage::url('profile/default.png')}}" alt="User Image" height="100px">
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

@section('js')
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#show').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#file").change(function() {
  readURL(this);
});
</script>
@endsection
