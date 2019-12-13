<?php
use App\Task;
Route::get('/', 'TasksController@index');

Route::get('/create', 'TasksController@create');

Route::post('/task', 'TasksController@store');

Route::get('/tasks/{task}', 'TasksController@show');

Route::get('tasks', function () {
	$tasks = App\Task::all();
    return response($tasks);
});

Route::get('date', 'TasksController@date');




