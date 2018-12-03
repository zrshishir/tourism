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
       },
        error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
        }
    })
}

function postingComment(postId){

    var comment = $('#comment').val();
    var url = $('#hiddenUrl').val();
    var urlimg = url + "/img/avatar.png";

     $.ajax({
       url: url + "/postComment",
       method: "GET",
       dataType: "json",
    //    processData: false,
       data:{'comment': comment, 'statusId': postId},
       
       success: function(data){
           console.log(data);
              $( "#statusNo"+postId ).append( '<div class="row media">'
                    +'<div class="col-md-1">'
                        +'<img class="align-self-center mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="32px" width="32px">'
                    +'</div>'
                    +'<div class="col-md-11 media-body">'
                        +'<h5 class="mt-0">Top-aligned media</h5>'
                        +'<p>'+data.comment+'</p>'
                        +'</div>'
                    +'</div>'
                 +'</div>'
             );
              $("#comment").val('');
              $("#statusNo"+postId).load();
              $("#allposts").load();
       },
        error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
        }
    })
}

function postingStatus(){
    var postingValue = $('#status').val();
    var url = $('#hiddenUrl').val();
    var urlimg = url + "/img/avatar.png";
    
    $.ajax({
       url: url + "/posting",
       method: "GET",
       dataType: "json",
    //    processData: false,
       data:{'postingV': postingValue},
       
       success: function(data){
           console.log(data);
           $( "#allposts" ).prepend( '<div class="col-md-2"><img class="align-self-center mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="64px" width="64px"></div>'
                +'<div class="col-md-10 media-body" >'
                +'<h5 class="mt-0">Top-aligned media</h5>'
                +'<p>'+data.post+'</p>'
                +'<button type="button" class="btn btn-small btn-primary"  onclick="likeStatus('+data.id+')">like</button>'
                +'<button type="button" class="btn btn-secondary btn-small" disabled id="likeCount'+data.id+'">'+data.like+'</button>'
                +'<br/>'
                +'<br/>'
                +'<textarea class="form-control" placeholder="comment for status" name="comment" id="comment" cols="60" rows="1"></textarea>'
                 +'<button class="btn btn-small btn-primary" type="button" onclick="postingComment('+data.id+')">Post</button>' + '</br>'
             );
        $("#status").val('');
        $('#allposts').load();
       },
        error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
        }
    })
}

$(document).ready(function(){
    var url = $('#hiddenUrl').val();
    var urlimg = url + "/img/avatar.png";
    $.ajax({
        url: url  + "/allposts",
        method: 'GET',
        dataType: 'json',
        processData: false,
        // contentType: true,
        
        success: function (data) {
         
            for (var i = 0; i < data.length; i++) {
                $( "#allposts" ).append( '<div class="col-md-2"><img class="align-self-center mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="64px" width="64px"></div>'
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
         error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
       
    });

    function makeString(comments, postId){
        var str = '';
        for (var i = comments.length - 1; i >= 0; i--) {
             str += '<div class="row" id="statusNo'+postId+'"><div class="row media">'
                                +'<div class="col-md-1">'
                                    +'<img class="align-self-center mr-3" src="'+ urlimg +'" alt="Generic placeholder image" height="32px" width="32px">'
                                +'</div>'
                                +'<div class="col-md-11 media-body">'
                                    +'<h5 class="mt-0">Top-aligned media</h5>'
                                    +'<p>'+comments[i].comment+'</p>'
                                    +'</div>'
                                +'</div>'
                             +'</div>'
        }
        str +=  '<textarea class="form-control" placeholder="comment for status" name="comment" id="comment" cols="60" rows="1"></textarea>'
                 +'<button class="btn btn-small btn-primary" type="button" onclick="postingComment('+postId+')">Post</button>' + '</br>'
        return str;
    }

    $('#postNow1').on('click', function(e){
        e.preventDefault();
        var postingStatus = $('#status').val();
        console.log(postingStatus);
        
        $.ajax({
            url: url  + "/posting",
            method: 'GET',
            dataType: 'json',
            // processData: false,
            data: [{'_token':$('meta[name="token"]').attr('content'),'postingStatus': postingStatus}],
            success: function (data) {
                console.log(data);
                $('#allposts').load();
                $('#status').val('');
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
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