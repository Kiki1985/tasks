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
				tasks.push($('<div/>').attr({ id:"task"+value.id+"", "data-date":""+value.dateToFinish+""}).css("margin-bottom", "45px").append(
                	   $('<p/>').attr({'class':'title', 'id':''+value.id+''}).text(value.title).css({"cursor":"pointer", "color":"red"}), 
					   $('<p/>').html("<b><i>Date to finish: </i></b>"+value.dateToFinish+""),
					   $('<div/>').attr('id', 'div'+value.id+'').css("display","none").append(
		               $('<p/>').text(value.description),$('<p/>').html("<b><i>Created at: </i></b>"+value.created_at+""),
		               $("<a/>").attr('href', "/tasks/"+value.id+"/edit").html("<button>Update task</button>"),
		               $("<button/>").attr({'class':'delete', 'id':''+value.id+''}).text("Delete task"),
		               $("<hr/>"))));
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
	$( "#expired" ).find( ".i" ).text( "Expired: " );
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