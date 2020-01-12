$( document ).ready(function() {
	
	$('#create_task').click(function() {
		dateToFinish = new Date($('input[name ="dateToFinish"]').val());
		$.get("date", function(date){
			current_date = new Date(date);
			if(dateToFinish < current_date){
				alert("Invalid date");
			}	
		});
		var title = $('input[name ="title"]').val();
		var description = $('textarea[name="description"]').val();
		var dateToFinish = $('input[name ="dateToFinish"]').val();
		$.ajax({
	        url: 'task',
	        type: 'get',
	        data: {title: title,description: description,dateToFinish: dateToFinish},
	        success: function(value){
	        	var task_create = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Date to finish: "+value.dateToFinish+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +
						  "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+

						  "<button id='delete"+value.id+"'>Delete task</button><hr>"+

						  "</div>";
				$( document ).ready(function() {
					$('#delete'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						$.ajax({
	        				url: '/delete/'+value.id+'',
	        				type: 'get',
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
				$('input[name ="dateToFinish"]').val('');
			}
		});
		return false;
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			var tasks_show = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Date to finish: "+value.dateToFinish+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +
						  "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+

						  "<button id='delete"+value.id+"'>Delete task</button><hr>"+

						  "</div>";

			$( document ).ready(function() {
					$('#delete'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						$.ajax({
	        				url: '/delete/'+value.id+'',
	        				type: 'get',
	        			});
					});
				});

			var h3_title = '<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>';
			var p_title = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>";

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

		var tasks_expired = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+" Expired: "+value.dateToFinish+"</p>" +
						  "<div id=div1_"+value.id+"></div>" +
						  "<div id=div_"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Expired: "+value.dateToFinish+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +

						  "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+

						  "<button id='delete"+value.id+"'>Delete task</button><hr>"+

						  "</div>";

				$( document ).ready(function() {
					$('#delete'+value.id+'').click(function() {
						$("#div_"+value.id+"").hide("fast");
						$("#div1_"+value.id+"").hide("fast");
						$.ajax({
	        				url: '/delete/'+value.id+'',
	        				type: 'get',
	        			});
					});
				});

		var h3_title = '<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>';
		var p_title = "<p style='cursor:pointer' id='p_"+value.id+"'>"+value.title+" Expired: "+value.dateToFinish+"</p>";

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