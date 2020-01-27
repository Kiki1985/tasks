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
