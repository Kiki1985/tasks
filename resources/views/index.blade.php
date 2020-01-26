@extends('layout')
@section('title', 'Tasks')
@section('content')
<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggleDiv" style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="title" required="required" /><br><br>
	<input type="date" name="dateToFinish" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="createTask">Create</button>
</form><br>
</div> <!-- end div id="slideToggleDiv" -->

<h2>Tasks</h2>
<div id="title">

@foreach($tasks as $task)
<div id="task{{$task->id}}" style='margin-bottom: 45px;'>
<p style='cursor:pointer' id='p{{$task->id}}'>{{$task->title}}</p>
<p> <b><i id='i{{$task->id}}'>Date to finish: </i></b>{{$task->dateToFinish}}</p>
<div id='div{{$task->id}}' style='display:none'>
<p>{{$task->description}}</p>
<p><b><i>Created at: </i></b>{{$task->created_at}}</p>
<a href='/tasks/{{$task->id}}/edit'><button>Update task</button></a>
<button id='delete{{$task->id}}'>Delete task</button><hr>
</div>
</div>
@endforeach
</div>

<h2>Expired tasks</h2>
<div id="expired">
@foreach($expireds as $expired)
<div id="task{{$expired->id}}" style='margin-bottom: 45px;'>
<p style='cursor:pointer' id='p{{$expired->id}}'>{{$expired->title}}</p>
<p> <b><i id='i{{$expired->id}}'>Date to finish: </i></b>{{$expired->dateToFinish}}</p>
<div id='div{{$expired->id}}' style='display:none'>
<p>{{$expired->description}}</p>
<p><b><i>Created at: </i></b>{{$expired->created_at}}</p>
<a href='/tasks/{{$expired->id}}/edit'><button>Update task</button></a>
<button id='delete{{$expired->id}}'>Delete task</button><hr>
</div>
</div>
@endforeach
</div>

</div>
@endsection
