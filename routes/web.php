<?php
Route::get('/', 'TasksController@index');

Route::get('task', 'TasksController@store');

Route::get('tasks', 'TasksController@showTasks');

Route::get('expired', 'TasksController@showExpired');

Route::get('date', 'TasksController@date');

Route::get('delete_task', 'TasksController@delete');

Route::get('/tasks/{task}', 'TasksController@edit');

Route::patch('/tasks/{task}', 'TasksController@update');


