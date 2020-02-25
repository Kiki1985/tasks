<?php
Route::get('/tasks', 'TasksController@index');

Route::post('/tasks', 'TasksController@store');

Route::get('/delete/{task}', 'TasksController@destroy');

Route::get('/tasks/{task}/edit', 'TasksController@edit');

Route::patch('/tasks/{task}', 'TasksController@update');

//Route::resource('tasks', 'TasksController');