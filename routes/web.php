<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
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
    return redirect()->route('login');  // Ganti dengan nama route login yang sesuai
});


Route::middleware(['auth.custom'])->group(function () {
    Route::get('produks', 'ProdukController@index')->name('produks.index');
    Route::get('produks/create', 'ProdukController@create')->name('produks.create');
    Route::post('produks', 'ProdukController@store')->name('produks.store');
    Route::get('produks/{produk}/edit', 'ProdukController@edit')->name('produks.edit');
    Route::put('produks/{produk}', 'ProdukController@update')->name('produks.update');
    Route::delete('produks/{produk}', 'ProdukController@destroy')->name('produks.destroy');
    Route::get('produks/{produk}', 'ProdukController@show')->name('produks.show');

    Route::get('penjualans', 'PenjualanController@index')->name('penjualans.index');
    Route::get('penjualans/create', 'PenjualanController@create')->name('penjualans.create');
    Route::post('penjualans', 'PenjualanController@store')->name('penjualans.store');
    Route::get('penjualans/{penjualan}/edit', 'PenjualanController@edit')->name('penjualans.edit');
    Route::put('penjualans/{penjualan}', 'PenjualanController@update')->name('penjualans.update');
    Route::delete('penjualans/{penjualans}', 'PenjualanController@destroy')->name('penjualans.destroy');
    Route::get('penjualans/{penjualan}', 'PenjualanController@show')->name('penjualans.show');
    
Route::get('/dashboard', function () {
    return view('dashboard.home');
})->name('dashboard.home');



Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetakPDF'])->name('laporan.cetak');


    Route::get('pelanggan', 'PelangganController@index')->name('pelanggan.index');
    Route::get('pelanggan/create', 'PelangganController@create')->name('pelanggan.create');
    Route::post('pelanggan', 'PelangganController@store')->name('pelanggan.store');
    Route::get('pelanggan/{pelanggans}/edit', 'PelangganController@edit')->name('pelanggan.edit');
    Route::put('pelanggan/{pelanggan}', 'PelangganController@update')->name('pelanggan.update');
    Route::delete('pelanggan/{pelanggan}', 'PelangganController@destroy')->name('pelanggan.destroy');
});

Route::get('penjualans/{id}/print', 'PenjualanController@print')->name('penjualans.print');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// routes/web.php

Route::get('/home', 'HomeController@index')->middleware('preventBackHistory')->name('home');

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// Route::get('/force-logout', function (Request $request) {
//     Auth::logout();
//     $request->session()->invalidate();
//     $request->session()->regenerateToken();
//     return redirect('/');
// });

// http://127.0.0.1:8000/force-logout

