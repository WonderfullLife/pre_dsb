<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/pengaturan-referensi/{tahun?}', function () {
    return view('pengaturan.pengaturan_referensi');
});
Route::get('/pengaturan-pengguna', function () {
    return view('pengaturan.pengaturan_pengguna');
});
Route::get('/maping-jenis/{tahun?}', 'MappingController@getHomeMapingJenis');
Route::get('/review-maping-jenis/{tahun?}', function () {
    return view('maping.review_mapping_jenis');
});

Route::get('/referensi/{tahun}', 'MappingController@ambilDataReferensi');
//Route::get('/referensi/{tahun}/{posisi}/{jumlah}','MappingController@ambilTempLimit');
Route::get('home', 'HomeController@index');
Route::get('maping/{jenis}/{tahun}/{apbdindex}', 'MappingController@prosedurMapping');
Route::get('cek_index/{jenis}/{tahun}', 'HomeController@cekIndex');
Route::get('kirim/{apbdindex}', 'MailController@kirim');


Route::get('data/jenis/{tahun}/{posisi}/{jumlah}', 'MappingController@getDataJenis');
Route::get('ref/jenis/{tahun}', 'MappingController@getRefJenis');
Route::get('kodesatker/temp_jenis/{id}', 'MappingController@getTempJenisSatker');

Route::get('pengaturan/pengguna', 'UserController@getAll');
Route::get('pengguna/{id}', 'UserController@getId');
Route::get('pengguna/{id}/edit', 'UserController@getEdit');
Route::get('pengguna/{id}/wilayah', 'UserController@getUserWilayah');
Route::post('form/pengguna/delete', 'UserController@postDeleteUser');
Route::post('form/pengguna/password', 'UserController@postResetPass');
Route::post('form/pengguna/tambah', 'UserController@postTambahUser');
Route::post('form/pengguna/edit', 'UserController@postEditUser');
Route::post('form/pengguna/edit/akses', 'UserController@postEditUserAkses');
Route::post('form/pengguna/edit/wilayah', 'UserController@postEditUserWilayah');
Route::get('referensi/{kodesatker}/{tahun}', 'HomeController@getBelumMapping');