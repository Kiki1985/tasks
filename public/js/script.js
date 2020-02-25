$(document).ready(function () {
    date = new Date().getFullYear() + "-" + ("0" + (new Date().getMonth() + 1)).slice(-2) + "-" + ("0" + new Date().getDate()).slice(-2);
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $('#createTask').click(function () {
        title = $('input[name ="title"]').val();
        inputDate = $('input[name ="dateToFinish"]').val();
        description = $('textarea[name="description"]').val();
        if (!title || !inputDate || !description) {
            alert("Please Fill All Required Fields");
            return false;
        }
        if (inputDate < date) {
            alert("Invalid date");
            return false;
        } else {
            $.ajax({
                url: 'tasks',
                type: 'post',
                data: {title: title,description: description,dateToFinish: inputDate},
                success: function (value) {
                    const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    finDate = new Date(value.dateToFinish);
                    createdAt = new Date(value.created_at);
                    finDate = months[finDate.getMonth()] + " " + finDate.getDate()+ ", " + finDate.getFullYear();
                    createdAt = months[createdAt.getMonth()] + " " + createdAt.getDate()+ ", " + createdAt.getFullYear();
                    tasks = $.makeArray($("#title").find("[data-date]"));
                    tasks.push(
                        $('<div/>').attr("data-date",""+value.dateToFinish+"").css("margin-bottom", "45px").append(
                            $('<p/>').attr('class','title').text(value.title).css("cursor","pointer"),
                            $('<p/>').html("<b><i>Date to finish: </i></b>"+finDate+""),
                            $('<div/>').css("display","none").append(
                                $('<p/>').text(value.description),
                                $('<p/>').html("<b><i>Created at: </i></b>"+createdAt+""),
                                $("<a/>").attr('href', "/tasks/"+value.id+"/edit").html("<button>Update task</button>"),
                                $("<button/>").attr({'class':'delete', 'id':''+value.id+''}).text("Delete task"),
                                $("<hr/>")
                            )
                        )
                    );
                    tasks.sort(function (a, b) {
                        return new Date($(a).data("date")) - new Date($(b).data("date"));
                    });
                    $("#title").html(tasks);
                    updateOrDelete();
                }
            });
        }
        $('input[name ="title"]').val('');
        $('textarea[name="description"]').val('');
        $('input[name ="dateToFinish"]').val('');
        return false;
    });
    $('#slideTask').click(function () {
        $(this).next().slideToggle("fast");
    });
    $("[data-date]").each(function () {
        if (($(this).data("date")) < date) {
            $(this).find(".i").text("Expired: ");
        }
    });
    function updateOrDelete()
    {
        $(".title").click(function () {
            $(this).next().next().slideToggle("fast");
        });
        $('.delete').click(function () {
            $(this).parent().parent().remove();
            $.get("delete/"+$(this).attr('id')+"");
        });
    }
    updateOrDelete();
});