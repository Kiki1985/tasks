$( document ).ready(function() {
date = new Date();
strDate = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
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
		        data: {title: title,description: description,dateToFinish: inputDate},
		        success: function(value){
		        	showTask(value);
				}
			});
		}
		$('input[name ="title"]').val('');
		$('textarea[name="description"]').val('');
		$('input[name ="dateToFinish"]').val('');
		return false;
	});

	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			showTask(value);
		});
	});

	function showTask(value){
		task = "<div id='task"+value.id+"' style='margin-bottom: 45px;'>"+
				"<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+"</p>"+
				"<p> <b><i id='i"+value.id+"'>Date to finish: </i></b>"+value.dateToFinish+"</p>"+
				"<div id='div"+value.id+"' style='display:none'>"+ 
				"<p>"+value.description+"</p>"+
				"<p><b><i>Created at: </i></b>"+value.created_at+"</p>"+
				"<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
				"<button id='delete"+value.id+"'>Delete task</button><hr>"+
				"</div></div>";
		
	    if(value.dateToFinish < strDate){
			$('#expMsg').text('');
			$('#expired').append(task);
			$('#i'+value.id+'').text(" Expired: ");
		}else{
			$('#msg').text('');
			$('#title').append(task);
		}

		$('#p'+value.id+'').click(function() {
			$('#div'+value.id+'').slideToggle("fast");
		});

		$('#delete'+value.id+'').click(function() {
			$("#task"+value.id+"").remove();
			if( $('#title').is(':empty') ) {
	    		$('#msg').html('<i>No tasks yet</i>');
			}
			if( $('#expired').is(':empty') ) {
	    		$('#expMsg').html('<i>No expired tasks</i>');
			}
			$.ajax({
	        url: '/delete/'+id+'',
	        type: 'get',
	       		  });
		});
	}
		
	$('#slideToggle').click(function() {
		$('#slideToggleDiv').slideToggle("fast");
	});
});