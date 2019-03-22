<?php


Route::any('/srilanka/purchase', 'Api\email\SriLankaController@purchase');
Route::any('/srilanka/verifymail', 'Api\email\SriLankaController@verifyMail');
Route::any('/srilanka/resetpass', 'Api\email\SriLankaController@resetPass');
Route::any('/srilanka/confirm', 'Api\email\SriLankaController@confirm');

//测试Redis
Route::any('/redis', 'Api\email\SriLankaController@testRedis');

Route::any('/taiwan/purchase', 'Api\email\TaiwanController@purchase');
Route::any('/taiwan/confirm', 'Api\email\TaiwanController@confirm');


Route::any('/mq/create', 'CreateQueueController@createMailQueue');
Route::any('/', 'IndexController@index');
