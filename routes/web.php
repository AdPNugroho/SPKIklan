<?php

Route::get('/','DashboardController@index');
Route::get('/alternatif','AlternatifController@index');
Route::get('/kriteria','KriteriaController@index');
Route::get('/evaluasi','EvaluasiController@index');
Route::get('/grafik','GrafikController@index');
Route::get('/kota','KotaController@index');
Route::get('/history','HistoryController@index');

Route::post('/alternatif/save','AlternatifController@save');
Route::post('/alternatif/getAlternatif','AlternatifController@getById');
Route::post('/alternatif/update','AlternatifController@update');
Route::get('/alternatif/data','AlternatifController@data');

Route::post('/kriteria/getKriteria','KriteriaController@getById');
Route::get('/kriteria/data','KriteriaController@data');

Route::post('/kota/save','KotaController@save');
Route::post('/kota/getKota','KotaController@getById');
Route::post('/kota/update','KotaController@update');
Route::post('/kota/delete','KotaController@delete');
Route::get('/kota/data','KotaController@data');

Route::post('/evaluasi/data','EvaluasiController@data');
Route::post('/evaluasi/matriks','EvaluasiController@MatriksSAW');
Route::post('/evaluasi/getEvaluasi','EvaluasiController@getById');

Route::post('/grafik/data','GrafikController@grafik');
Route::post('/grafik/save','GrafikController@saveGrafik');
Route::get('/grafik/table','GrafikController@tableVektor');

Route::post('/history/detail','HistoryController@detail');
Route::post('/history/delete','HistoryController@delete');
Route::get('/history/data','HistoryController@data');

Route::post('/alternatif/save','DataManage@saveAlternatif');
Route::post('/alternatif/delete','DataManage@deleteAlternatif');
Route::post('/kriteria/update','DataManage@updateKriteria');
Route::post('/evaluasi/update','DataManage@updateEvaluasi');