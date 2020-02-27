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
                                $('<div/>').css("display","none").append(
                                    $('<h3/>').text('Update task'),
                                    $('<form/>').attr({'method':'post', 'action':'tasks/'+value.id+''}).append(
                                        $('<input/>').attr({'type':'hidden', 'name':'_method', 'value':'patch'}),
                                        $('<input/>').attr({'type':'hidden', 'name':'_token', 'value':''+$('meta[name="csrf-token"]').attr('content')+''}),
                                        $('<input/>').attr({'type':'text', 'name':'title', 'value':''+value.title+'', 'required': 'required'}),
                                        $('<br/>'),
                                        $('<br/>'),
                                        $('<input/>').attr({'type':'date', 'name':'dateToFinish', 'value':''+ new Date(value.dateToFinish).getFullYear() + "-" + ("0" + (new Date(value.dateToFinish).getMonth() + 1)).slice(-2) + "-" + ("0" + new Date(value.dateToFinish).getDate()).slice(-2)+'', 'required': 'required'}),
                                        $('<br/>'),
                                        $('<br/>'),
                                        $('<textarea/>').attr({'name':'description', 'required':'required'}).text(''+value.description+''),
                                        $('<br/>'),
                                        $('<br/>'),
                                        $('<input/>').attr({'type':'submit', 'value':'Update'}),
                                        $('<br/>'),
                                        $('<br/>')
                                    )
                                ),
                                $("<button/>").attr('class','update').text("Update task"),
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
        $('input[name ="title"]').first().val('');
        $('textarea[name="description"]').first().val('');
        $('input[name ="dateToFinish"]').first().val('');
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
            $.ajax({
                url: 'tasks/'+$(this).attr('id')+'',
                type: 'post',
                data: {'_method': 'DELETE'}
            });
        });
        $('.update').click(function () {
            $(this).prev().slideToggle("fast");
            $(this).remove();
        });
    }
    updateOrDelete();
});