@extends('index')

@include('time')

@include('layouts.terbilang')

@section('title')
  Cetak Tagihan
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Cetak Tagihan
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="/tagihan"> Tagihan Beasiswa</a></li>
      <li><a href="/tagihan/lihat/{{$id}}"> Detail Tagihan Beasiswa</a></li>
      <li class="active"> Cetak Tagihan</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
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
              <h4><i class="icon fa fa-close"></i> Error!</h4>
              {{Session::get('error')}}
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
              Field dengan tanda (<span class="req">*</span>) wajib diisi.
            </div>
            @endif

            <form class="form-horizontal" action="/tagihan/invoice/cetak/print/{{$id}}" method="post">
            {{ csrf_field() }}

              <div class="form-group {{$errors->has('id') ? 'has-error' : ''}}">
                <label for="id" class="col-md-2 control-label">No Invoice</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='id' placeholder="Nomor Invoice" name="id" value="{{$ar->invoice}}" readonly style="background-color:#FFF">
                  @if ($errors->has('id'))
                  <span class="help-block">
                      {{$errors->first('id')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('termin') ? 'has-error' : ''}}">
                <label for="termin" class="col-md-2 control-label">Termin</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='termin' placeholder="Termin" name="termin" value="{{$ar->termin}}" readonly style="background-color:#FFF">
                  @if ($errors->has('termin'))
                  <span class="help-block">
                      {{$errors->first('termin')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('tagihan') ? 'has-error' : ''}}">
                <label for="tagihan" class="col-md-2 control-label">Biaya Tagihan</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='tagihan' placeholder="Biaya Tagihan" name="tagihan" value="{{number_format($total->tagihan,0,'.','.')}}" readonly style="background-color:#FFF">
                  @if ($errors->has('tagihan'))
                  <span class="help-block">
                      {{$errors->first('tagihan')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('terbilang') ? 'has-error' : ''}}">
                <label for="terbilang" class="col-md-2 control-label">Terbilang</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='terbilang' placeholder="Terbilang" name="terbilang" value="{{terbilang($total->tagihan)}}" readonly style="background-color:#FFF">
                  @if ($errors->has('terbilang'))
                  <span class="help-block">
                      {{$errors->first('terbilang')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
                <label for="nama" class="col-md-2 control-label">Nama Dekan SPS ITB <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='nama' placeholder="Nama Lengkap dan Jabatan" name="nama" value="{{old('nama')}}">
                  @if ($errors->has('nama'))
                  <span class="help-block">
                      {{$errors->first('nama')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('nip') ? 'has-error' : ''}}">
                <label for="nip" class="col-md-2 control-label">NIP Dekan SPS ITB <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='nip' placeholder="NIP Dekan SPS ITB" name="nip" value="{{old('nip')}}">
                  @if ($errors->has('nip'))
                  <span class="help-block">
                      {{$errors->first('nip')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('diterima') ? 'has-error' : ''}}">
                <label for="diterima" class="col-md-2 control-label">Sudah Diterima Dari <span class="req">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" id='diterima' placeholder="Sudah Diterima Dari" name="diterima" value="Kuasa Pengguna Anggaran Direktorat Jenderal Sumber Daya Ilmu Pengetahuan, Teknologi, dan Pendidikan Tinggi">
                  @if ($errors->has('diterima'))
                  <span class="help-block">
                      {{$errors->first('diterima')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group {{$errors->has('deskripsi') ? 'has-error' : ''}}">
                <label for="deskripsi" class="col-md-2 control-label">Deskripsi Pembayaran <span class="req">*</span></label>
                <div class="col-md-8">
                  <textarea class="form-control" id='deskripsi' name='deskripsi' placeholder="Deskripsi Pembayaran" rows="5">{{old('deskripsi')}}</textarea>
                  @if ($errors->has('deskripsi'))
                  <span class="help-block">
                      {{$errors->first('deskripsi')}}
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                  <button type="reset" class="btn btn-default">Reset</button>
                  <button type="submit" class="btn btn-info">Cetak</button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>

  </section>

@endsection
