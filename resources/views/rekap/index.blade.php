@extends('index')

@section('title')
  Laporan Beasiswa
@endsection

@section('content')
<section class="content-header">
  <h1>
    Laporan Beasiswa
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Laporan Beasiswa</li>
  </ol>
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
                  <th><center>No SPK</center></th>
                  <th><center>Beasiswa / Tahun / Termin</center></th>
                  <th><center>No Invoice</center></th>
                  <th><center>No SP2D</center></th>
                  <th><center>No BPP Ke ITB</center></th>
                  <th><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($data as $key)
                <tr>
                  <td width="1%"><center>{{$no++}}</center></td>
                  <td><center>{{$key->spk}}</center></td>
                  <td width="20%"><center>{{$key->source}} / {{$key->year}} / {{$key->termin}}</center></td>
                  <td width="15%">
                    <center>
                      @if ($key->invoice == null)
                        -
                      @else
                        {{$key->invoice}}
                      @endif
                    </center>
                  </td>
                  <td width="15%">
                    <center>
                      @if ($key->no_payment == null)
                        -
                      @else
                        {{$key->no_payment}}
                      @endif
                    </center>
                  </td>
                  <td width="15%">
                    <center>
                      @if ($key->no_pay == null)
                        -
                      @else
                        {{$key->no_pay}}
                      @endif
                    </center>
                  </td>
                  <td width="1%">
                    <center>
                      <a href="/rekapan/download/file/{{\Crypt::encrypt($key->id)}}/{{\Crypt::encrypt($key->id_invoice)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Download Beasiswa {{$key->source}} - {{$key->year}} - {{$key->termin}}" data-placement="left"><span class="fa fa-file-excel-o"></span></a>
                    </center>
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
