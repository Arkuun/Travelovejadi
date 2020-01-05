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
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/','MainController@index')->name('beranda');
Route::get('/event','MainController@event')->name('event');



Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('checklogin');

Route::group(['middleware' => ['auth']], function () {
	Route::get('logout','Auth\LoginController@logout')->name('manage.logout');
	Route::get('/manage', 'HomeController@index')->name('manage');
	//admin
	Route::get('/manage/admin', 'AdminController@index')->name('xadmin.index');
	Route::post('manage/admin/getdata', 'AdminController@getData')->name('xadmin.getdata');
    Route::get('manage/admin/tambah','AdminController@tambah')->name('xadmin.tambah');
    Route::get('manage/admin/ubah/{id}','AdminController@ubah')->name('xadmin.ubah');
    Route::post('manage/admin/simpan/{id?}','AdminController@simpan')->name('xadmin.simpan');
    Route::delete('manage/admin/hapus/{id}','AdminController@hapus')->name('xadmin.hapus');
    Route::get('manage/admin/detail/{id}','AdminController@detail')->name('xadmin.detail');


    //pengguna
    Route::get('/manage/pengguna', 'PenggunaController@index')->name('xpengguna.index');
    Route::post('manage/pengguna/getdata', 'PenggunaController@getData')->name('xpengguna.getdata');
    Route::get('manage/pengguna/tambah','PenggunaController@tambah')->name('xpengguna.tambah');
    Route::get('manage/pengguna/ubah/{id}','PenggunaController@ubah')->name('xpengguna.ubah');
    Route::post('manage/pengguna/simpan/{id?}','PenggunaController@simpan')->name('xpengguna.simpan');
    Route::delete('manage/pengguna/hapus/{id}','PenggunaController@hapus')->name('xpengguna.hapus');
    Route::get('manage/pengguna/detail/{id}','PenggunaController@detail')->name('xpengguna.detail');


    //wahana
    Route::get('/manage/wahana', 'WahanaController@index')->name('xwahana.index');
    Route::post('manage/wahana/getdata', 'WahanaController@getData')->name('xwahana.getdata');
    Route::get('manage/wahana/tambah','WahanaController@tambah')->name('xwahana.tambah');
    Route::get('manage/wahana/ubah/{id}','WahanaController@ubah')->name('xwahana.ubah');
    Route::post('manage/wahana/simpan/{id?}','WahanaController@simpan')->name('xwahana.simpan');
    Route::delete('manage/wahana/hapus/{id}','WahanaController@hapus')->name('xwahana.hapus');
    Route::get('manage/wahana/detail/{id}','WahanaController@detail')->name('xwahana.detail');


	//wisata
	Route::get('/manage/wisata', 'WisataController@index')->name('xwisata.index');
	Route::post('manage/wisata/getdata', 'WisataController@getData')->name('xwisata.getdata');
    Route::get('manage/wisata/tambah','WisataController@tambah')->name('xwisata.tambah');
    Route::get('manage/wisata/ubah/{id}','WisataController@ubah')->name('xwisata.ubah');
    Route::post('manage/wisata/simpan/{id?}','WisataController@simpan')->name('xwisata.simpan');
    Route::delete('manage/wisata/hapus/{id}','WisataController@hapus')->name('xwisata.hapus');
    Route::get('manage/wisata/detail/{id}','WisataController@detail')->name('xwisata.detail');


    //Berita
    Route::get('/manage/berita', 'BeritaController@index')->name('xberita.index');
    Route::post('manage/berita/getdata', 'BeritaController@getData')->name('xberita.getdata');
    Route::get('manage/berita/tambah','BeritaController@tambah')->name('xberita.tambah');
    Route::get('manage/berita/ubah/{id}','BeritaController@ubah')->name('xberita.ubah');
    Route::post('manage/berita/simpan/{id?}','BeritaController@simpan')->name('xberita.simpan');
    Route::delete('manage/berita/hapus/{id}','BeritaController@hapus')->name('xberita.hapus');
    Route::get('manage/berita/detail/{id}','BeritaController@detail')->name('xberita.detail');

	//share
	Route::get('/manage/share', 'ShareController@index')->name('xshare.index');
	Route::post('manage/share/getdata', 'ShareController@getData')->name('xshare.getdata');
    Route::get('manage/share/tambah','ShareController@tambah')->name('xshare.tambah');
    Route::get('manage/share/ubah/{id}','ShareController@ubah')->name('xshare.ubah');
    Route::post('manage/share/simpan/{id?}','ShareController@simpan')->name('xshare.simpan');
    Route::delete('manage/share/hapus/{id}','ShareController@hapus')->name('xshare.hapus');
    Route::get('manage/share/detail/{id}','ShareController@detail')->name('xshare.detail');

    //kategori
    Route::get('manage/kategori/detail/{id}','KategoriController@detail')->name('xkategori.detail');
    Route::get('/manage/kategori', 'KategoriController@index')->name('xkategori.index');
    Route::post('manage/kategori/getdata', 'KategoriController@getData')->name('xkategori.getdata');
    Route::post('manage/kategori/simpan/{id?}','KategoriController@simpan')->name('xkategori.simpan');
    Route::delete('manage/kategori/hapus/{id}','KategoriController@hapus')->name('xkategori.hapus');
    Route::get('manage/kategori/tambah','KategoriController@tambah')->name('xkategori.tambah');
    Route::get('manage/kategori/ubah/{id}','KategoriController@ubah')->name('xkategori.ubah');


      //kategoriwahana
    Route::get('manage/kategoriwahana/detail/{id}','KategoriWahanaController@detail')->name('xkategoriwahana.detail');
    Route::get('/manage/kategoriwahana','KategoriWahanaController@index')->name('xkategoriwahana.index');
    Route::post('manage/kategoriwahana/getdata','KategoriWahanaController@getData')->name('xkategoriwahana.getdata');
    Route::post('manage/kategoriwahana/simpan/{id?}','KategoriWahanaController@simpan')->name('xkategoriwahana.simpan');
    Route::delete('manage/kategoriwahana/hapus/{id}','KategoriWahanaController@hapus')->name('xkategoriwahana.hapus');
    Route::get('manage/kategoriwahana/tambah','KategoriWahanaController@tambah')->name('xkategoriwahana.tambah');
    Route::get('manage/kategoriwahana/ubah/{id}','KategoriWahanaController@ubah')->name('xkategoriwahana.ubah');


    //event
    Route::get('/manage/event','EventController@index')->name('xevent.index');
    Route::post('manage/event/getdata','EventController@getData')->name('xevent.getdata');
    Route::get('manage/event/tambah','EventController@tambah')->name('xevent.tambah');
    Route::get('manage/event/ubah/{id}','EventController@ubah')->name('xevent.ubah');
    Route::post('manage/event/simpan/{id?}','EventController@simpan')->name('xevent.simpan');
    Route::delete('manage/event/hapus/{id}','EventController@hapus')->name('xevent.hapus');
    Route::get('manage/event/detail/{id}','EventController@detail')->name('xevent.detail');



    //slider
    Route::get('manage/slider', 'SliderController@index')->name('slider.index');
    Route::get('manage/slider/detail/{id}', 'SliderController@detail')->name('slider.detail');
    Route::delete('manage/slider/delete/{id}', 'SliderController@delete')->name('slider.hapus');
    Route::get('manage/slider/tambah','SliderController@tambah')->name('slider.tambah');
    Route::get('manage/slider/ubah/{id}','SliderController@ubah')->name('slider.ubah');
    Route::post('manage/slider/save/{id?}', 'SliderController@save')->name('slider.simpan');
    Route::get('manage/slider/sorting/{id}', 'SliderController@sorting')->name('slider.sorting');


});

