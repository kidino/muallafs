<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::redirect('/', '/admin/login');

Route::get('/', 'MuallafController@welcome')->name('welcome');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::group(['middleware' => 'admin.user'], function () {
        Route::get('/muallafs/{id}/nota', 'MuallafController@notelist')->name('notelist');
        Route::post('/muallafs/{id}/nota', 'MuallafController@savenote')->name('savenote');
        Route::get('/muallafs/{id}/surat', 'MuallafController@surat')->name('surat');


        Route::get('/muallafs/api/days_month_count', 'MuallafController@days_month_count')->name('api_days_month_count');
        Route::get('/muallafs/api/month_gender', 'MuallafController@conversion_by_gender_30')->name('api_by_gender_30');
        Route::get('/muallafs/api/month_race', 'MuallafController@conversion_by_race_30')->name('api_by_race_30');
    });
});
