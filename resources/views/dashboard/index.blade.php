@extends('index')

@include('time')

@section('title')
  Dashboard
@endsection

@section('content')
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>

<section class="content-header">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Selamat datang @if ((Auth::user()->gender)=='l') Bapak  @else Ibu @endif {{Auth::user()->tb_name}} {{Auth::user()->name}} {{Auth::user()->l_name}} {{Auth::user()->ta_name}}
      </div>
      @if ($check == true)
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Warning!</h4>
          Your account is not secure, update your password <a href="/profile/password"><strong>now</strong></a>.
        </div>
      @endif
    </div>
  </div>
</section>

<section class="content">

  @if (count($termin)>0)
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <h3>Daftar Termin yang belum di tagih</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th><center>Nama Termin</center></th>
                  <th><center>No SPK</center></th>
                  <th width="15%"><center>Sumber Beasiswa</center></th>
                  <th width="15%"><center>Tanggal Tagihan</center></th>
                  <th width="15%"><center>Jatuh Tempo</center></th>
                  <th width="5%"><center>Status</center></th>
                  <th width="10%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($termin as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->name}}</center></td>
                  <td><center>{{$key->scholarship->spk}}</center></td>
                  <td><center>{{$key->scholarship->source}} - {{$key->scholarship->year}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date))}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date_end))}}</center></td>
                  <td>
                    <center>
                      @if($today < $key->date_end)
                        <label class="label label-xs label-info" data-toggle="tooltip" title="Belum memasuki jatuh tempo"><span class="fa fa-check"></span></label>
                      @elseif($today == $key->date_end)
                        <label class="label label-xs label-warning" data-toggle="tooltip" title="Telah memasuki jatuh tempo"><span class="fa fa-warning"></span></label>
                      @elseif($today > $key->date_end)
                        <label class="label label-xs label-danger" data-toggle="tooltip" title="Telah melebihi jatuh tempo"><span class="fa fa-close"></span></label>
                      @endif
                    </center>
                  </td>
                  <td>
                    <center>
                      <a href="/beasiswa/lihat/{{\Crypt::encrypt($key->id_scholarship)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data Beasiswa {{$key->scholarship->source}} - {{$key->scholarship->year}}" data-placement="left"><span class="fa fa-eye"></span></a>
                      <a href="/tagihan/tambah" class="btn btn-sm btn-success" data-toggle="tooltip" title="Input Data Termin" data-placement="left"><span class="fa fa-check"></span></a>
                    </center>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer">
          <h3>Catatan :</h3>
          <label class="label label-xs label-info"><span class="fa fa-check"></span></label> = Belum memasuki jatuh tempo;
          <label class="label label-xs label-warning"><span class="fa fa-warning"></span></label> = Telah memasuki jatuh tempo;
          <label class="label label-xs label-danger"><span class="fa fa-close"></span></label> = Telah melebihi jatuh tempo
        </div>
      </div>

    </div>
  </div>
  @endif

  @if (count($invoice)>0)
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <h3>Daftar Invoice yang belum di bayar</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example2" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th><center>No Invoice</center></th>
                  <th><center>No SPK</center></th>
                  <th width="10%"><center>Termin</center></th>
                  <th width="15%"><center>Sumber Beasiswa</center></th>
                  <th width="15%"><center>Tanggal Tagihan</center></th>
                  <th width="15%"><center>Jatuh Tempo</center></th>
                  <th width="5%"><center>Status</center></th>
                  <th width="10%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($invoice as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->invoice}}</center></td>
                  <td><center>{{$key->scholarship->spk}}</center></td>
                  <td><center>{{$key->termin}}</center></td>
                  <td><center>{{$key->scholarship->source}} - {{$key->scholarship->year}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date))}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date_end))}}</center></td>
                  <td>
                    <center>
                      @if($today < $key->date_end)
                        <label class="label label-xs label-info" data-toggle="tooltip" title="Belum memasuki jatuh tempo"><span class="fa fa-check"></span></label>
                      @elseif($today == $key->date_end)
                        <label class="label label-xs label-warning" data-toggle="tooltip" title="Telah memasuki jatuh tempo"><span class="fa fa-warning"></span></label>
                      @elseif($today > $key->date_end)
                        <label class="label label-xs label-danger" data-toggle="tooltip" title="Telah melebihi jatuh tempo"><span class="fa fa-close"></span></label>
                      @endif
                    </center>
                  </td>
                  <td>
                    <center>
                      <a href="/tagihan/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data Tagihan{{$key->invoice}}" data-placement="left"><span class="fa fa-eye"></span></a>
                      <a href="/pembayaran/tambah" class="btn btn-sm btn-success" data-toggle="tooltip" title="Input Data Tagihan" data-placement="left"><span class="fa fa-check"></span></a>
                    </center>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer">
          <h3>Catatan :</h3>
          <label class="label label-xs label-info"><span class="fa fa-check"></span></label> = Belum memasuki jatuh tempo;
          <label class="label label-xs label-warning"><span class="fa fa-warning"></span></label> = Telah memasuki jatuh tempo;
          <label class="label label-xs label-danger"><span class="fa fa-close"></span></label> = Telah melebihi jatuh tempo
        </div>
      </div>

    </div>
  </div>
  @endif

  @if (count($tagihan)>0)
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header">
          <h3>Daftar BPP (SP2D) yang belum ke ITB</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example3" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th width="1%"><center>No</center></th>
                  <th><center>No Pembayaran</center></th>
                  <th width="20%"><center>Termin</center></th>
                  <th width="20%"><center>Sumber Beasiswa</center></th>
                  <th width="15%"><center>Tanggal Tagihan</center></th>
                  <th width="15%"><center>Tanggal Pembayaran</center></th>
                  <th width="12%"><center>Aksi</center></th>
                </tr>
              </thead>
              @php
                $no=1;
              @endphp
              <tbody>
                @foreach ($tagihan as $key)
                <tr>
                  <td><center>{{$no++}}</center></td>
                  <td><center>{{$key->no_payment}}</center></td>
                  <td><center>{{$key->termin}}</center></td>
                  <td><center>{{$key->ar->scholarship->source}} - {{$key->ar->scholarship->year}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->ar->date))}}</center></td>
                  <td><center>{{strftime('%d %B %Y',strtotime($key->date_sp2d))}}</center></td>
                  <td>
                    <center>
                      <a href="/pembayaran/lihat/{{\Crypt::encrypt($key->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Lihat Data {{$key->no_payment}}" data-placement="left"><span class="fa fa-eye"></span></a>
                      <a href="/penagihan/tambah" class="btn btn-sm btn-success" data-toggle="tooltip" title="Input Data {{$key->no_payment}}" data-placement="left"><span class="fa fa-check"></span></a>
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
  @endif

</section>

@endsection
