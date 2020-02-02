$( document ).ready(function() {
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
			    success: function(value){
			    tasks = $.makeArray($( "#title" ).find("[data-date]"));
                task = "<div id=task"+value.id+" style='margin-bottom: 45px;' data-date='"+value.dateToFinish+"'>"+
                       "<p class='title' style='cursor:pointer;color:red' id='"+value.id+"'>"+value.title+"</p>"+
                       "<p> <b><i id='i"+value.id+"'>Date to finish: </i></b>"+value.dateToFinish+"</p>"+
                       "<div id='div"+value.id+"' style='display:none'>"+ 
                       "<p>"+value.description+"</p>"+
                       "<p><b><i>Created at: </i></b>"+value.created_at+"</p>"+
                       "<a href='/tasks/"+value.id+"/edit'><button>Update task</button></a>"+
                       "<button class='delete' id='"+value.id+"'>Delete task</button><hr>"+
                       "</div></div>";
                tasks.push(task);
                    tasks.sort(function(a, b) {
                        return new Date($(a).data("date")) - new Date($(b).data("date"));
                    });
                    $("#title").html(tasks);
                    $("#expired p").removeClass("title");
					updateOrDelete();
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
	function updateOrDelete(){
		$(".title").click(function(){
	    id = $(this).attr("id");
		$('#div'+id+'').slideToggle("fast");
		});
		$('.delete').click(function() {
		id = $(this).attr("id");
		$("#task"+id+"").remove();
		$.get("delete/"+id+"");
		});
	}
	updateOrDelete();
});