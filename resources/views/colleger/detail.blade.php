@extends('index')

@section('title')
    {{$colleger->name}}
@endsection

@section('content')
<section class="content-header">
  <h1>
    {{$colleger->name}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/mahasiswa"><i class="fa fa-dashboard"></i> Mahasiswa</a></li>
    <li class="active"> {{$colleger->name}}</li>
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
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td width="15%">NIM</td>
                  <td width="5%">:</td>
                  <td>{{$colleger->nim}}</td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td>{{$colleger->name}}</td>
                </tr>
                <tr>
                  <td>Semester</td>
                  <td>:</td>
                  <td>
                    @if ($colleger->chapter == 1)
                      Ganjil
                    @else
                      Genap
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Program</td>
                  <td>:</td>
                  <td>
                    @if ($colleger->program == 1)
                      Magister
                    @elseif ($colleger->program == 2)
                      Doctor
                    @else
                      -
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Fakultas</td>
                  <td>:</td>
                  <td>{{$colleger->faculty}}</td>
                </tr>
                <tr>
                  <td>Program Studi</td>
                  <td>:</td>
                  <td>{{$colleger->prodi}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="/master/mahasiswa/ubah/{{$nim}}" class="btn btn-md btn-warning" data-toggle="tooltip" title="Update Data"><span class="fa fa-edit"></span></a>
          @if ($colleger->status == 1)
          <a href="/master/mahasiswa/nonaktif/{{$nim}}" class="btn btn-md btn-danger" data-toggle="tooltip" title="Non Aktifkan Data"><span class="fa fa-close"></span></a>
          @else
            <a href="/master/mahasiswa/aktif/{{$nim}}" class="btn btn-md btn-info" data-toggle="tooltip" title="Aktifkan Data"><span class="fa fa-check"></span></a>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
