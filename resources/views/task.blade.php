<div id="task{{$task->id}}" style='margin-bottom: 45px;' data-date='{{$task->dateToFinish}}'>
	<p class="title" id='{{$task->id}}' style='cursor:pointer'>{{$task->title}}</p>
	<p> <b><i class='i'>Date to finish: </i></b>{{$task->dateToFinish}}</p>
	<div id='div{{$task->id}}' style='display:none'>
		<p>{{$task->description}}</p>
		<p><b><i>Created at: </i></b>{{$task->created_at}}</p>
		<a href='/tasks/{{$task->id}}/edit'><button>Update task</button></a>
		<button class="delete" id='{{$task->id}}'>Delete task</button><hr>
	</div>
</div>






