@extends('index')

@section('title')
  Laporan Keuangan
@endsection

@section('content')
<section class="content-header">
  <h1>
    Laporan Keuangan
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Laporan Keuangan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
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
            Field dengan field (<span class="req">*</span>) wajib diisi.
          </div>
          @endif

          <form class="form-horizontal" action="keuangan/download" method="post">
            {{ csrf_field() }}

            <div class="form-group {{$errors->has('spk') ? 'has-error' : ''}}">
              <label for="spk" class="col-md-2 control-label">No SPK <span class="req">*</span></label>
              <div class="col-md-8">
                <select class="form-control select" name="spk" id="spk">
                  <option value=""></option>
                  @foreach ($scholarship as $key)
                  <option value="{{$key->id}}">{{$key->spk}} - {{$key->source}} - {{$key->year}}</option>
                  @endforeach
                </select>
                @if ($errors->has('spk'))
                <span class="help-block">
                    {{$errors->first('spk')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
              <label for="termin" class="col-md-2 control-label">Termin</label>
              <div class="col-md-8">
                <select class="form-control select" name="termin" id="termin">
                  <option value=""></option>
                </select>
                @if ($errors->has('termin'))
                <span class="help-block">
                    {{$errors->first('termin')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
              <label for="status" class="col-md-2 control-label">Status Beasiswa</label>
              <div class="col-md-8">
                <select class="form-control" name="status" id="status">
                  <option value="0"></option>
                  <option value="1">Telah Di Tagihkan</option>
                  <option value="2">Telah Di ITB (SP2D)</option>
                  <option value="3">Telah Di Bayar Ke ITB</option>
                  <option value="4">Belum Di Tagihkan</option>
                  <option value="5">Belum Di ITB (SP2D)</option>
                  <option value="6">Belum Di Bayar Ke ITB</option>
                </select>
                @if ($errors->has('status'))
                <span class="help-block">
                    {{$errors->first('status')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group {{$errors->has('semester') ? 'has-error' : ''}}">
              <label for="semester" class="col-md-2 control-label">Semester Tagihan</label>
              <div class="col-md-8">
                <select class="form-control" name="semester" id="semester">
                  <option value=""></option>
                </select>
                @if ($errors->has('semester'))
                <span class="help-block">
                    {{$errors->first('semester')}}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label"></label>
              <div class="col-md-8">
                <button type="submit" name="button" class="btn btn-success">Download Excel</button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $("#spk").change(function(){
      var val = $(this).val();
      $.get("/laporan/cari/termin/"+val, function(response){
        $.each(response, function (index, value) {
          $('#termin').append('<option value="'+value.id+'">'+value.name+'</option>')
        });
      });

      $.get("/laporan/cari/semester/"+val, function(response){
        $.each(response, function (index, value) {
          $('#semster').append('<option value="'+value.id+'">'+value.name+'</option>')
        });
      });
    });
  });
</script>
@endsection
