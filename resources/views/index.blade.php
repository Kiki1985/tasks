@extends('layout')
@section('title', 'Tasks')
@section('content')
<button id="slideTask"><b>Create a new task </b></button>
<div style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="title" required="required" /><br><br>
	<input type="date" name="dateToFinish" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="createTask">Create</button>
</form><br>
</div> <!-- end div id="slideTask" -->
<div id="title">
@foreach($tasks as $task)
<div style='margin-bottom: 45px;' data-date='{{$task->dateToFinish}}'>
	<p class="title" style='cursor:pointer'>{{$task->title}}</p>
	<p> 
	<b><i class='i'>Date to finish: </i></b> 
	{{$task->dateToFinish->toFormattedDateString()}}
	</p>
	<div style='display:none'>
		<p>{{$task->description}}</p>
		<p><b><i>Created at: </i></b>{{$task->created_at->diffForHumans()}}</p>
		<div style='display:none'>
			<h3>Update {{$task->title}}</h3>
			<form method="POST" action="/tasks/{{$task->id}}">
			@method('PATCH')
			@csrf
			<input type="text" name="title" placeholder="task" value="{{$task->title}}" required="required" /><br><br>
			<input type="date" name="dateToFinish" value="{{date('Y-m-d',strtotime($task->dateToFinish))}}"  required="required" /><br><br>
			<textarea name="description" placeholder="description" autocomplete="off" required="required" />{{$task->description}}</textarea><br><br>
			<input type="submit" value="Update">
			</form><br>
		</div>
		<button class="update">Update task</button>
		<button class="delete" id='{{$task->id}}'>Delete task</button><hr>
	</div>
</div>
@endforeach
</div>
@endsection
