$( document ).ready(function() {
	function showTasks(){
		var tasks = new Array();
		jQuery.getJSON("tasks", function(data) {
			$.each(data, function(key, value){
				if(value.dateToFinish >= strDate){
				task = "<div id=task"+value.id+" style='margin-bottom: 45px;'>"+
				   "<p style='cursor:pointer;color:red' id='p"+value.id+"'>"+value.title+"</p>"+
				   "<p> <b><i id='i"+value.id+"'>Date to finish: </i></b>"+value.dateToFinish+"</p>"+
				   "<div id='div"+value.id+"' style='display:none'>"+ 
				   "<p>"+value.description+"</p>"+
				   "<p><b><i>Created at: </i></b>"+value.created_at+"</p>"+
				   "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
				   "<button id='delete"+value.id+"'>Delete task</button><hr>"+
				   "</div></div>";
				tasks.push(task);
				deleteOrUpdate(value);
				}
			});
			$("#title").html(tasks);
		});
	}
date = new Date();
strDate = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
var CSRFtoken = $('meta[name="csrf-token"]').attr('content');
	$('#createTask').click(function() {
		title = $('input[name ="title"]').val();
		inputDate = $('input[name ="dateToFinish"]').val();
		description = $('textarea[name="description"]').val();
		if(!title || !inputDate || !description) {
			alert("Please Fill All Required Fields");
			return false;
		}
		if(inputDate < strDate){
			alert("Invalid date");
			return false;
		}else{
			$.ajax({
			    url: 'tasks',
			    type: 'post',
			    data: {_token:CSRFtoken,title: title,description: description,dateToFinish: inputDate},
			    success: function(){
					showTasks();
				}
			});
		}
		$('input[name ="title"]').val('');
		$('textarea[name="description"]').val('');
		$('input[name ="dateToFinish"]').val('');
		return false;
	});
	$('#slideToggle').click(function() {
		$('#slideToggleDiv').slideToggle("fast");
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			deleteOrUpdate(value);
		});
	});
	function deleteOrUpdate(value){
		$( document ).ready(function() {
			$('#p'+value.id+'').click(function() {
				$('#div'+value.id+'').slideToggle("fast");
			});
			$('#delete'+value.id+'').click(function() {
				$("#task"+value.id+"").remove();
				$.ajax({
		       		url: '/delete/'+value.id+'',
		        	type: 'get',
		       	});
				if(("#task"+value.id+"").length) {
					$('#title').html('<p><i>No tasks yet</i></p>')
				 	$('#expired').html('<p><i>No expired tasks</i></p>')
				}
			});
		});
	}
});