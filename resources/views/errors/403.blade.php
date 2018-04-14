@extends('errors/index')

@section('title')
403 Forbidden
@endsection

@section('main')
<div class="lockscreen-logo">
  <a href="/"><b>403</b> FORBIDDEN</a>
</div>

<div class="lockscreen-item">

</div>
<div class="text-center" style="margin-bottom:10px">
  <h4>Anda tidak memilik hak akses link tersebut.</h4>
</div>
<div class="help-block text-center" style="margin-bottom:40px">
  Jika ini adalah masalah silahkan hubungi admin.<br><a href="/" class="btn btn-md btn-primary">Kembali Ke Dashboard</a>
</div>
<div class="lockscreen-footer text-center">
  Copyright &copy; 2018 <b><a href="http://www.itb.ac.id" target="_blank" class="text-black">Institut Teknologi Bandung</a></b>
  All rights reserved
</div>
@endsection
