<?php
Route::get('/', 'TasksController@index');

Route::post('/tasks', 'TasksController@store');

Route::get('/tasks', 'TasksController@show');

Route::get('/delete/{task}', 'TasksController@destroy');

Route::get('/tasks/{task}/edit', 'TasksController@edit');

Route::patch('/tasks/{task}', 'TasksController@update');

//Route::resource('tasks', 'TasksController');

Route::get('/expired', 'ExpiredTasksController@show');


