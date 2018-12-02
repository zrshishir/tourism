function likeStatus(statusId){
    var url = $('#hiddenUrl').val();
    $.ajax({
       url: url + "/likeStatus",
       method: "GET",
       dataType: "json",
    //    processData: false,
       data:{'statusId': statusId},
       
       success: function(data){
           console.log(data);
           $("#likeCount"+statusId).text(data[0]);
       }
    })
}

$(document).ready(function(){
    var url = $('#hiddenUrl').val();
    var urlimg = url + "/img/avatar.png";
    $.ajax({
        url: url  + "/allposts",
        method: 'get',
        dataType: 'json',
        processData: false,
        // contentType: true,
        
        success: function (data) {
            // console.log(data[0].comments);
            // for(var i = 0; i < data.length; i++){
            //     console.log(Array.isArray(data[i].comments));
            //     // if(data[i].comments){
            //     //     console.log('yes');
            //     // }
            //     // console.log(data[i].comments);
            // }
            // // if(data[0].comments){
            // //     console.log(data[0].comments[0].comment);
            // // }
            // return true;
            for (var i = 0; i < data.length; i++) {
                $( "#allposts" ).append( '<div class="col-md-2"><img class="align-self-start mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="64px" width="64px"></div>'
                +'<div class="col-md-10 media-body" >'
                +'<h5 class="mt-0">Top-aligned media</h5>'
                +'<p>'+data[i].post+'</p>'
                +'<button type="button" class="btn btn-small btn-primary"  onclick="likeStatus('+data[i].id+')">like</button>'
                +'<button type="button" class="btn btn-secondary btn-small" disabled id="likeCount'+data[i].id+'">'+data[i].like+'</button>'
                +'<br/>'
                +'<br/>'+
                    ((Array.isArray(data[i].comments))?(makeString(data[i].comments, data[i].id)):'</div>')
                
             );
            }
            $('#allposts').load();
            return true;
        },
       
    });

    function makeString(comments, postId){
        var str = '';
        for (var i = comments.length - 1; i >= 0; i--) {
             str += '<div class="row"><div class="row media">'
                                +'<div class="col-md-1">'
                                    +'<img class="align-self-start mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="32px" width="32px">'
                                +'</div>'
                                +'<div class="col-md-11 media-body">'
                                    +'<h5 class="mt-0">Top-aligned media</h5>'
                                    +'<p>'+comments[i].comment+'</p>'
                                    +'</div>'
                                +'</div>'
                             +'</div>'
        }
        str +=  '<textarea class="form-control" placeholder="comment for status" name="comment" id="comment" cols="60" rows="1"></textarea>'
                 +'<button class="btn btn-small btn-primary" type="button" onclick="postComment('+postId+')">Post</button>' + '</br>'
        return str;
    }

    $('#postNow').on('submit', function(){
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