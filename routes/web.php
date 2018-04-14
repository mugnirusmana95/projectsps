<?php

Route::get('/','DashboardController@index');

//User
Route::group([
  'prefix' => '/users',
  'middleware' => 'isDevAdmin'
], function () {
  Route::get('/','UserController@index');
  Route::get('/tambah','UserController@create');
  Route::post('/tambah/simpan','UserController@store');
  Route::get('/detail/{id}','UserController@detail');
  Route::get('/ubah/{id}','UserController@edit');
  Route::put('/ubah/simpan/{id}','UserController@update');
  Route::get('/reset/{id}','UserController@reset');
});

//Faculty
Route::group([
  'prefix' => '/master/fakultas',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','FacultyController@index');
  Route::get('/tambah','FacultyController@create');
  Route::post('/tambah/simpan','FacultyController@store');
  Route::get('/detail/{id}','FacultyController@detail');
  Route::get('/ubah/{id}','FacultyController@edit');
  Route::put('/ubah/simpan/{id}','FacultyController@update');
  Route::get('/hapus/{id}','FacultyController@destroy');
  Route::get('/program_studi/{id}','FacultyController@createStudy');
  Route::post('/program_studi/simpan/{id}','FacultyController@storeStudy');
  Route::get('/program_studi/ubah/{id}','FacultyController@editStudy');
  Route::put('/program_studi/ubah/simpan/{id}','FacultyController@updateStudy');
  Route::get('/program_studi/hapus/{id}','FacultyController@destroyStudy');
});

//Study Program
Route::group([
  'prefix' => '/master/program_studi',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','StudyController@index');
  Route::get('//tambah','StudyController@create');
  Route::post('/tambah/simpan','StudyController@store');
  Route::get('/ubah/{id}','StudyController@edit');
  Route::put('/ubah/simpan/{id}','StudyController@update');
  Route::get('/hapus/{id}','StudyController@destroy');
  Route::get('/search/{name}','StudyController@search');
});

//Colleger
Route::group([
  'prefix' => '/master/mahasiswa',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','CollegerController@index');
  Route::get('//tambah','CollegerController@create');
  Route::post('/tambah/simpan','CollegerController@store');
  Route::get('/lihat/{nim}','CollegerController@detail');
  Route::get('/ubah/{nim}','CollegerController@edit');
  Route::put('/ubah/simpan/{nim}','CollegerController@update');
  Route::get('/aktif/{nim}','CollegerController@aktif');
  Route::get('/nonaktif/{nim}','CollegerController@nonaktif');
});

//Type of Scholarship
Route::group([
  'prefix' => '/master/jenis_beasiswa',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','TypescholarshipController@index');
  Route::get('/tambah','TypescholarshipController@create');
  Route::post('/tambah/simpan','TypescholarshipController@store');
  Route::get('/ubah/{id}','TypescholarshipController@edit');
  Route::put('/ubah/simpan/{id}','TypescholarshipController@update');
  Route::get('/hapus/{id}','TypescholarshipController@destroy');
});

//Source of Scholarship
Route::group([
  'prefix' => '/master/sumber_beasiswa',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','SourcescholarshipController@index');
  Route::get('/tambah','SourcescholarshipController@create');
  Route::post('/tambah/simpan','SourcescholarshipController@store');
  Route::get('/ubah/{id}','SourcescholarshipController@edit');
  Route::put('/ubah/simpan/{id}','SourcescholarshipController@update');
  Route::get('/hapus/{id}','SourcescholarshipController@destroy');
});

//BPP Prodi
Route::group([
  'prefix' => '/master/bpp_prodi',
  'middleware' => 'isDevAdmin'
], function() {
  Route::get('/','BppprodiController@index');
  Route::get('/tambah','BppprodiController@create');
  Route::post('/tambah/simpan','BppprodiController@store');
  Route::get('/ubah/{id}','BppprodiController@edit');
  Route::put('/ubah/simpan/{id}','BppprodiController@update');
  Route::get('/hapus/{id}','BppprodiController@destroy');
});

//Scholarship
Route::group([
  'prefix' => '/beasiswa'
], function() {
  Route::get('/','ScholarshipController@index');
  Route::get('/tambah','ScholarshipController@create');
  Route::post('/tambah/simpan','ScholarshipController@store');
  Route::get('/lihat/{id}','ScholarshipController@detail');
  Route::get('/ubah/{id}','ScholarshipController@edit');
  Route::put('/ubah/simpan/{id}','ScholarshipController@update');
  Route::get('/hapus/{id}','ScholarshipController@destroy');
  Route::get('/mahasiswa/{id}','ScholarshipController@createMahasiswa');
  Route::post('/mahasiswa/simpan/{id}','ScholarshipController@storeMahasiswa');
  Route::get('/mahasiswa/ubah/{id}','ScholarshipController@editMahasiswa');
  Route::put('/mahasiswa/ubah/simpan/{id}','ScholarshipController@updateMahasiswa');
  Route::get('/mahasiswa/hapus/{id}','ScholarshipController@destroyMahasiswa');
  Route::get('/termin/{id}','ScholarshipController@createTermin');
  Route::post('/termin/simpan/{id}','ScholarshipController@storeTermin');
  Route::get('/termin/ubah/{id}','ScholarshipController@editTermin');
  Route::put('/termin/ubah/simpan/{id}','ScholarshipController@updateTermin');
  Route::get('/termin/hapus/{id}','ScholarshipController@destroyTermin');
  Route::get('/download/{id}','ScholarshipController@downloadExcel');
  Route::get('/mahasiswa/search/{nim}','ScholarshipController@searchMahasiswa');
  Route::get('/mahasiswa/hitung/{sks}/{nim}','ScholarshipController@hitungSks');
});

//Account Receivable(Invoice)
Route::group([
  'prefix' => '/tagihan'
], function() {
  Route::get('/','ArController@index');
  Route::get('/tambah','ArController@create');
  Route::post('/tambah/simpan','ArController@store');
  Route::get('/lihat/{id}','ArController@detail');
  Route::get('/ubah/{id}','ArController@edit');
  Route::put('/ubah/simpan/{id}','ArController@update');
  Route::get('/hapus/{id}','ArController@destroy');
  Route::get('/mahasiswa/{id}','ArController@createMahasiswa');
  Route::post('/mahasiswa/simpan/{id}','ArController@storeMahasiswa');
  Route::get('/mahasiswa/ubah/{id}','ArController@editMahasiswa');
  Route::put('/mahasiswa/ubah/simpan/{id}','ArController@updateMahasiswa');
  Route::get('/mahasiswa/hapus/{id}','ArController@destroyMahasiswa');
  Route::get('/invoice/cetak/{id}','ArController@printInvoice');
  Route::get('/download/{id}','ArController@downloadExcel');
  Route::get('/termin/search/{id}','ArController@searchTermin');
  Route::get('/total/search/{id}','ArController@searchTagihan');
  Route::get('/invoice/search/{id}','ArController@searchInvoice');
  Route::get('/invoice/find','ArController@findStudent')->name('admin.find.student');
});

//Account Receivable Payment
Route::group([
  'prefix' => '/pembayaran'
], function() {
  Route::get('/','ArpController@index');
  Route::get('/tambah','ArpController@create');
  Route::post('/tambah/simpan','ArpController@store');
  Route::get('/lihat/{id}','ArpController@detail');
  Route::get('/ubah/{id}','ArpController@edit');
  Route::put('/ubah/simpan/{id}','ArpController@update');
  Route::get('hapus/{id}','ArpController@destroy');
  Route::get('/tagihan/search/{id}','ArpController@searchTagihan');
  Route::get('/id/search/{id}','ArpController@searchId');
});

//Account Payable
Route::group([
  'prefix' => '/penagihan'
], function() {
  Route::get('/','ApController@index');
  Route::get('/tambah','ApController@create');
  Route::post('/tambah/simpan','ApController@store');
  Route::get('/lihat/{id}','ApController@detail');
  Route::get('/ubah/{id}','ApController@edit');
  Route::put('/ubah/simpan/{id}','ApController@update');
  Route::get('hapus/{id}','ApController@destroy');
  Route::get('/total/search/{id}','ApController@searchNopay');
});

//Profile
Route::group([
  'prefix' => '/profile'
], function() {
  Route::get('/','ProfileController@index');
  Route::get('/ubah','ProfileController@edit');
  Route::put('/ubah/simpan','ProfileController@update');
  Route::get('/akun','ProfileController@account');
  Route::put('/akun/simpan','ProfileController@UpdateAccount');
  Route::get('/foto','ProfileController@avatar');
  Route::put('/foto/simpan','ProfileController@UpdateAvatar');
  Route::get('/password','ProfileController@password');
  Route::put('/password/simpan','ProfileController@UpdatePassword');
});

Route::group([
  'prefix' => '/rekapan'
], function() {
  Route::get('/','RekapanController@index');
  Route::get('/download/file/{id}/{id_invoice}','RekapanController@downloadExcel');
});

Auth::routes();
