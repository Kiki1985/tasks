<?php
Route::get('/', 'TasksController@index');

Route::get('/create', 'TasksController@create');

Route::post('/task', 'TasksController@store');

Route::get('/tasks/{task}', 'TasksController@show');


