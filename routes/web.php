<?php
Route::get('/', 'TasksController@index');

Route::get('task', 'TasksController@store');

Route::get('/tasks/{task}', 'TasksController@show');

Route::get('tasks', 'TasksController@showTask');

Route::get('date', 'TasksController@date');




