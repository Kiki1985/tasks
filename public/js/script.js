$( document ).ready(function() {
	
	$('#create_task').click(function() {
		expected_finish_date = new Date($('input[name ="expected_finish_date"]').val());
		$.get("date", function(date){
			current_date = new Date(date);
			if(expected_finish_date < current_date){
				alert("Invalid date");
			}	
		});
		var title = $('input[name ="title"]').val();
		var description = $('textarea[name="description"]').val();
		var expected_finish_date = $('input[name ="expected_finish_date"]').val();
		$.ajax({
	        url: 'task',
	        type: 'get',
	        data: {title: title,description: description,expected_finish_date: expected_finish_date},
	        success: function(value){
	        	var task_create = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Expected finish date: "+value.expected_finish_date+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +
						  "<a href='/tasks/"+value.id+"'><button>Update task</button></a>"+

						  "<button id='delete_"+value.id+"'>Delete task</button><hr>"+

						  "</div>";
				$( document ).ready(function() {
					$('#delete_'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						var id = value.id;
						$.ajax({
	        				url: 'delete_task',
	        				type: 'get',
	        				data: {id: id},
	        				/*success: function(deleted_task){
	        					alert(deleted_task);
	        				}*/
	        			});
					});
				});

				var h3_title = '<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>';
				var p_title = '<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p>';

	        	$('#p_msg').text('');
	        	$('#div_title').prepend(task_create);
				$('#p_'+value.id+'').click(function() {
					$(this).text('');
					$('#div1_'+value.id+'').html(h3_title);
					$("#div_"+value.id+"").slideDown("fast");
					$('#h3_'+value.id+'').click(function() {
						$(this).text('');
						$('#p_'+value.id+'').html(p_title);
						$("#div_"+value.id+"").slideUp("fast");
					});
				});
				$('input[name ="title"]').val('');
				$('textarea[name="description"]').val('');
				$('input[name ="expected_finish_date"]').val('');
			}
		});
		return false;
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			var tasks_show = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Expected finish date: "+value.expected_finish_date+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +
						  "<a href='/tasks/"+value.id+"'><button>Update task</button></a>"+

						  "<button id='delete_"+value.id+"'>Delete task</button><hr>"+

						  "</div>";

			$( document ).ready(function() {
					$('#delete_'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						var id = value.id;
						$.ajax({
	        				url: 'delete_task',
	        				type: 'get',
	        				data: {id: id},
	        				/*success: function(deleted_task){
	        					alert(deleted_task);
	        				}*/
	        			});
					});
				});

			var h3_title = '<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>';
			var p_title = '<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p>';

		$('#div_title').append(tasks_show);
			$('#p_'+value.id+'').click(function() {
				$(this).text('');
				$('#div1_'+value.id+'').html(h3_title);
				$("#div_"+value.id+"").slideDown("fast");
				$('#h3_'+value.id+'').click(function() {
					$(this).text('');
					$('#p_'+value.id+'').html(p_title);
					$("#div_"+value.id+"").slideUp("fast");
				});
			});
		});
	});
		//var msg ='Today';
	
	jQuery.getJSON("expired", function(data) {

		$.each(data, function(key, value){

		var tasks_expired = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Expected finish date: "+value.expected_finish_date+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +

						  "<a href='/tasks/"+value.id+"'><button>Update task</button></a>"+

						  "<button id='delete_"+value.id+"'>Delete task</button><hr>"+

						  "</div>";

				$( document ).ready(function() {
					$('#delete_'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						var id = value.id;
						$.ajax({
	        				url: 'delete_task',
	        				type: 'get',
	        				data: {id: id},
	        				/*success: function(deleted_task){
	        					alert(deleted_task);
	        				}*/
	        			});
					});
				});

		var h3_title = '<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>';
		var p_title = '<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p>';

		$('#div_expired').append(tasks_expired);

			$('#p_'+value.id+'').click(function() {
				$(this).text('');
				$('#div1_'+value.id+'').html(h3_title);
				$("#div_"+value.id+"").slideDown("fast");

				$('#h3_'+value.id+'').click(function() {
					$(this).text('');
					$('#p_'+value.id+'').html(p_title);
					$("#div_"+value.id+"").slideUp("fast");
				});
			});
		});
	});

	$('#slideToggle').click(function() {
		$('#slideToggle_div').slideToggle("slow");
	});

});