$(document).ready(function(){
    var url = $('#hiddenUrl').val();
    $.ajax({
        url: url  + "/allposts",
        method: 'get',
        dataType: 'json',
        processData: false,
        // contentType: true,
        
        success: function (data) {
            console.log(data);
            // $('#modal_title').text(customer_name);
            // var t = $('#customer_users_datatable').DataTable();
            // t.rows().remove().draw();
            for (var i = 0; i < data.length; i++) {
                $("<div class='col-md-2'><img class='align-self-start mr-3' src='{{ url("+'img/avatar.png'+") }}' alt='Generic placeholder image' height='64px' width='64px'></div>").appendTo( "#allposts" );
                // t.row.add([
                //     i + 1,
                //     data[i].name,
                //     data[i].email,
                //     '<span class="label label-info">User</span>',
                //     '<span ' + ((data[i].status == 'Active') ? 'class="label label-success"' : 'class="label label-danger"') + '>' +
                //     data[i].status + '</span>'
                // ]).draw(false);
            }
            // $('#customer_users').modal('show');
        },
    });


    $('#postNow').on('click', function(){
        var postingStatus = $('#status').val();
        
        // var url = $('#hiddenUrl').val();
        // console.log(url);
        
        $.ajax({
            url: url + "/posting",
            method: 'get',
            dataType: 'json',
            processData: true,
            // contentType: true,
            data: {'postingStatus': postingStatus},
            // beforeSend: function (request) {
            //     return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            // },
            success: function (data) {
                console.log(data);
                // $('#modal_title').text(customer_name);
                // var t = $('#customer_users_datatable').DataTable();
                // t.rows().remove().draw();
                // for (var i = 0; i < data.length; i++) {
                //     t.row.add([
                //         i + 1,
                //         data[i].name,
                //         data[i].email,
                //         '<span class="label label-info">User</span>',
                //         '<span ' + ((data[i].status == 'Active') ? 'class="label label-success"' : 'class="label label-danger"') + '>' +
                //         data[i].status + '</span>'
                //     ]).draw(false);
                // }
                // $('#customer_users').modal('show');
            },
        });
       
    })
    
})


$("#postingNowasa").click(function (event) {
    event.preventDefault();
    $('.loading').show();
    // var form = $(this);
    var url = $('#hiddenUrl').val();
    // var data = new FormData($(this)[0]);
    var data = $('#status').val();
    console.log(data);
    // var url = form.attr("action");
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.fail) {
                $('#frm textarea.required').each(function () {
                    // index = $(this).attr('MemberId');
                    // if (index in data.errors) {
                    //     $("#form-" + index + "-error").addClass("has-error");
                    //     $("#" + index + "-error").html(data.errors[index]);
                    // }
                    // else {
                    //     $("#form-" + index + "-error").removeClass("has-error");
                    //     $("#" + index + "-error").empty();
                    // }
                });
                $('#focus').focus().select();
            } else {
                $(".has-error").removeClass("has-error");
                $(".help-block").empty();
                $('.loading').hide();
                ajaxLoad(data.url, data.content);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
    return false;
});