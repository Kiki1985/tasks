<div style='margin-bottom: 45px;' data-date='{{$task->dateToFinish}}'>
	<p class="title" style='cursor:pointer'>{{$task->title}}</p>
	<p> <b><i class='i'>Date to finish: </i></b>{{\Carbon\Carbon::parse($task->dateToFinish)->toFormattedDateString()}}</p>
	<div style='display:none'>
		<p>{{$task->description}}</p>
		<p><b><i>Created at: </i></b>{{$task->created_at->toFormattedDateString()}}</p>
		<a href='/tasks/{{$task->id}}/edit'><button>Update task</button></a>
		<button class="delete" id='{{$task->id}}'>Delete task</button><hr>
	</div>
</div>






