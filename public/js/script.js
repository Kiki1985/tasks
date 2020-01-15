$( document ).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$('#createTask').click(function() {
		dateToFinish = new Date($('input[name ="dateToFinish"]').val());
		finDate = dateToFinish.getFullYear() + "/" + (dateToFinish.getMonth()+1) + "/" + dateToFinish.getDate();
		date = new Date();
		strDate = date.getFullYear() + "/" + (date.getMonth()+1) + "/" + date.getDate();
		
		var title = $('input[name ="title"]').val();
		var dateToFinish = $('input[name ="dateToFinish"]').val();
		var description = $('textarea[name="description"]').val();
		
		if(title == null || title == "") {
			alert("Please Fill Tittle Field");
			return false;
		}
		if(dateToFinish == null || dateToFinish == "") {
			alert("Please Fill Date Field");
			return false;
		}
		if(description == null || description == "") {
			alert("Please Fill Description Field");
			return false;
		}
		if(finDate < strDate){
			alert("Invalid date");
			return false;
		}else{
			$.ajax({
		        url: 'tasks',
		        type: 'post',
		        data: {title: title,description: description,dateToFinish: dateToFinish},
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
		Task = "<div id=task"+value.id+">"+
					 "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+"Date to finish: "+value.dateToFinish+"</p>" +
					 "<div id=div"+value.id+" style='display:none'><hr>" + 
					 "<p>"+value.description+"</p>" +
					 "<p>Date to finish: "+value.dateToFinish+"</p>" +
					 "<p>Created at: "+value.created_at+"</p>" +
					 "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
					 "<button id='delete"+value.id+"'>Delete task</button><hr>"+
					 "</div></div>";
			
		date = new Date();
		strDate = date.getFullYear() + "/" + (date.getMonth()+1) + "/" + date.getDate();
		dateToFinish = new Date(value.dateToFinish);
		dateToFinish = dateToFinish.getFullYear() + "/" + (dateToFinish.getMonth()+1) + "/" + dateToFinish.getDate();
	    if(dateToFinish < strDate){
			$('#expMsg').text('');
			$('#expired').append(Task);
		}else{
			$('#msg').text('');
			$('#title').prepend(Task);
		}

		$('#p'+value.id+'').click(function() {
		$('#div'+value.id+'').slideToggle("fast");
		});

		$( document ).ready(function() {
			$('#delete'+value.id+'').click(function() {
			$("#task"+value.id+"").remove();
			if( $('#title').is(':empty') ) {
	    		$('#msg').html('<i>No tasks yet</i>');
			}
			if( $('#expired').is(':empty') ) {
	    		$('#expMsg').html('<i>No expired tasks</i>');
			}
			$.ajax({
	        url: '/delete/'+value.id+'',
	        type: 'get',
	       		  });
			});
		});
	}
		
		$('#slideToggle').click(function() {
		$('#slideToggleDiv').slideToggle("fast");
	});
});