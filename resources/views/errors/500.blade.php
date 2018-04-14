@extends('errors/index')

@section('title')
400 Internal Server Error
@endsection

@section('main')
<div class="lockscreen-logo">
  <a href="/"><b>500</b> INTERNAL SERVEL ERROR</a>
</div>

<div class="lockscreen-item">

</div>
<div class="text-center" style="margin-bottom:10px">
  <h4>Terjadi kesalahan dengan server</h4>
</div>
<div class="help-block text-center" style="margin-bottom:40px">
  Jika ini adalah masalah silahkan hubungi admin.
</div>
<div class="lockscreen-footer text-center">
  Copyright &copy; 2018 <b><a href="http://www.itb.ac.id" target="_blank" class="text-black">Institut Teknologi Bandung</a></b>
  All rights reserved
</div>
@endsection
