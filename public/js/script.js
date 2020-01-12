$( document ).ready(function() {
	
	$('#createTask').click(function() {
		dateToFinish = new Date($('input[name ="dateToFinish"]').val());
		$.get("date", function(date){
			currentDate = new Date(date);
			if(dateToFinish < currentDate){
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
	        	var createTask = "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>" +
						  "<div id=div1"+value.id+"></div>" +
						  "<div id=div"+value.id+" style='display:none'><hr>" + 
						  "<p>"+value.description+"</p>" +
						  "<p>Date to finish: "+value.dateToFinish+"</p>" +
						  "<p>Created at: "+value.created_at+"</p>" +
						  "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
						  "<button id='delete"+value.id+"'>Delete task</button><hr>"+
						  "</div>";
				
				var h3Title = '<h3 style="cursor:pointer" id="h3'+value.id+'">'+value.title+'</h3>';
				var pTitle = '<p style="cursor:pointer" id="p'+value.id+'">'+value.title+'Date to finish: '+value.dateToFinish+'</p>';

	        	$('#msg').text('');

	        	$('#title').prepend(createTask);

				$('#p'+value.id+'').click(function() {
					$(this).text('');
					$('#div1'+value.id+'').html(h3Title);
					$("#div"+value.id+"").slideDown("fast");
					$('#h3'+value.id+'').click(function() {
						$(this).text('');
						$('#p'+value.id+'').html(pTitle);
						$("#div"+value.id+"").slideUp("fast");
					});
				});

				$('input[name ="title"]').val('');
				$('textarea[name="description"]').val('');
				$('input[name ="dateToFinish"]').val('');

				$( document ).ready(function() {
					$('#delete'+value.id+'').click(function() {
						$("#div"+value.id+"").hide("fast");
						$("#div1"+value.id+"").hide("fast");
						$.ajax({
	        				url: '/delete/'+value.id+'',
	        				type: 'get',
	        			});
					});
				});
			}
		});
		return false;
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			var showTask = "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>" +
						   "<div id=div1"+value.id+"></div>" +
						   "<div id=div"+value.id+" style='display:none'><hr>" + 
						   "<p>"+value.description+"</p>" +
						   "<p>Date to finish: "+value.dateToFinish+"</p>" +
						   "<p>Created at: "+value.created_at+"</p>" +
						   "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
						   "<button id='delete"+value.id+"'>Delete task</button><hr>"+
						   "</div>";

			var h3Title = '<h3 style="cursor:pointer" id="h3'+value.id+'">'+value.title+'</h3>';
			var pTitle = "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+" Date to finish: "+value.dateToFinish+"</p>";

			$( document ).ready(function() {
				$('#delete'+value.id+'').click(function() {
					$("#div"+value.id+"").hide("fast");
					$("#div1"+value.id+"").hide("fast");
					$.ajax({
		        		url: '/delete/'+value.id+'',
		        		type: 'get',
		        	});
				});
			});

			$('#title').append(showTask);

			$('#p'+value.id+'').click(function() {
				$(this).text('');
				$('#div1'+value.id+'').html(h3Title);
				$("#div"+value.id+"").slideDown("fast");
				$('#h3'+value.id+'').click(function() {
					$(this).text('');
					$('#p'+value.id+'').html(pTitle);
					$("#div"+value.id+"").slideUp("fast");
				});
			});

		});

	});
		//var msg ='Today';
	
	jQuery.getJSON("expired", function(data) {
		$.each(data, function(key, value){
			var expiredTask = "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+" Expired: "+value.dateToFinish+"</p>"+
						      "<div id=div1"+value.id+"></div>" +
						      "<div id=div"+value.id+" style='display:none'><hr>" + 
						  	  "<p>"+value.description+"</p>" +
						  	  "<p>Expired: "+value.dateToFinish+"</p>" +
						  	  "<p>Created at: "+value.created_at+"</p>" +
							  "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
							  "<button id='delete"+value.id+"'>Delete task</button><hr>"+
							  "</div>";

			$( document ).ready(function() {
				$('#delete'+value.id+'').click(function() {
					$("#div"+value.id+"").hide("fast");
					$("#div1"+value.id+"").hide("fast");
					$.ajax({
		        		url: '/delete/'+value.id+'',
		        		type: 'get',
		        	});
				});
			});

			var h3Title = '<h3 style="cursor:pointer" id="h3'+value.id+'">'+value.title+'</h3>';
			var pTitle = "<p style='cursor:pointer' id='p"+value.id+"'>"+value.title+" Expired: "+value.dateToFinish+"</p>";

			$('#expired').append(expiredTask);

			$('#p'+value.id+'').click(function() {
				$(this).text('');
				$('#div1'+value.id+'').html(h3Title);
				$("#div"+value.id+"").slideDown("fast");

				$('#h3'+value.id+'').click(function() {
					$(this).text('');
					$('#p'+value.id+'').html(pTitle);
					$("#div"+value.id+"").slideUp("fast");
				});
			});
		});
		
	});

	$('#slideToggle').click(function() {
		$('#slideToggleDiv').slideToggle("fast");
	});

});