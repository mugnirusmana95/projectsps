@extends('index')

@section('title')
  Tambah Program Studi ({{$faculty->name}})
@endsection

@section('content')
<section class="content-header">
  <h1>
    Tambah Program Studi ({{$faculty->name}})
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="/master/fakultas"> Fakultas</a></li>
    <li class="active"> Tambah Program Studi ({{$faculty->name}})</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <form class="form-horizontal" action="/master/fakultas/program_studi/simpan/{{$id}}" method="post">
          {{ csrf_field() }}
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

            <table class="table table-hover" id='pTable'>
              <tbody>

              </tbody>
            </table>

            <table class="table table-hover">
              <tbody>
                <tr>
                  <td width="15%"></td>
                  <td><a  href="javascript:;" class="btn btn-md btn-warning" id='addButId'>Tambah Field</a></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script>
  //Funsi untuk set nomor
  function arrangeSno() {
    var i=1;
    $('#pTable tr').each(function() {
    $(this).find(".sNo").html('Program Studi ('+i+') <span class="req">*</span>');
    //Memunculkan tombol tambah foto jika kurang atau sama dengan 10
    i++;
    });
  }

  //Fungsi untuk menambah row
  $(document).ready(function(){
  $('#addButId').click(function(){
    var sno=$('#pTable tr').length+1;
    //Menghilangkan tombol tambah foto jika lebih atau sama dengan 10
    trow =  "<tr><td width='15%' class='sNo'> Program Studi ("+sno+") <span class='req'>*</span></td>"+
            "<td><input type='text' class='form-control' name='name[]' maxlength='35' required></td>"+
            "<td width='1%'><button data-toggle='tooltip' title='Hapus' type='button' class='btn btn-danger rButton'><span class='fa fa-trash'></span></button></td></tr>";
            $('#pTable').append(trow);
    });
  });

  //Fungsi untuk menghapus row
  $(document).on('click', 'button.rButton', function () {
    $(this).closest('tr').remove();
    arrangeSno();
    return false;
  });

  function coba(){
    $('#addButId').attr('disabled','disabled');
  }

</script>
@endsection
