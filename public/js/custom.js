$(function(){
    $('.delete-swl').click(function(e){
        
        e.preventDefault();
        var text = "You will not be able to recover this!";

        if($(this).data('msg')) {
            text = $(this).data('msg');
        }

        var href = $(this).attr('href');
        var that = this;

        swal({
            title: "Are you sure?",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false

        }, function(result){
            if(result){
                if(typeof href !== 'undefined'){
                    window.location.href = href;
                } else {
                    $(that).closest("form").submit();
                }
            }
        });
    });
});

$(function(){
    $('.delete-swl-group').click(function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var that = this;

        swal({
            title: "Are you sure?",
            text: "Email addresses will be deleted associated with this group",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false

        }, function(result){
            if(result){
                if(typeof href !== 'undefined'){
                    window.location.href = href;
                } else {
                    $(that).closest("form").submit();
                }
            }
        });
    });
});

$(document).ready(function () {
    $('.summernote').summernote({
        height: 300
    });
    $('.small-editor').summernote({
        height: 100,
        codemirror: {// codemirror options
            theme: 'monokai'
        }
    });
    // $('.note-toolbar .note-fontsize,.note-toolbar .note-help,.note-toolbar .note-fontname,.note-toolbar .note-height,.note-toolbar .note-table,.note-insert').remove();
    
});
$(function() {
    /*
     * Multiple drop down select
     */

    $(".select_box").select2({});
    $(".select_2_to").select2({
        tags: true,
        allowClear: true,
        placeholder:'Select or Write',
        tokenSeparators: [',', ' ']
    });
    $(".select_multi").select2({
        allowClear: true,
        placeholder:'Select Multiple',
        tokenSeparators: [',', ' ']
    });

});

function formatAMPM(date) {
date = new Date(date);
  var day = date.getDate();
  var month = date.getMonth();
  var year = date.getFullYear();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = day + '/' + month + '/' + year + ' ' +  hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


(function (window, document, $, undefined) {

    window.APP_COLORS = {
        'primary': '#5d9cec',
        'success': '#27c24c',
        'info': '#23b7e5',
        'warning': '#ff902b',
        'danger': '#f05050',
        'inverse': '#131e26',
        'green': '#37bc9b',
        'pink': '#f532e5',
        'purple': '#7266ba',
        'dark': '#3a3f51',
        'yellow': '#fad732',
        'gray-darker': '#232735',
        'gray-dark': '#3a3f51',
        'gray': '#dde6e9',
        'gray-light': '#e4eaec',
        'gray-lighter': '#edf1f2'
    };

    window.APP_MEDIAQUERY = {
        'desktopLG': 1200,
        'desktop': 992,
        'tablet': 768,
        'mobile': 480
    };

})(window, document, window.jQuery);
(function (window, document, $, undefined) {

    $(function () {

        if (!$.fn.easyPieChart) return;

        var pieOptions1 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: APP_COLORS['success'],
            trackColor: false,
            scaleColor: false,
            lineWidth: 10,
            lineCap: 'circle'
        };
        $('.easypiechart').easyPieChart(pieOptions1);

        var pieOptions2 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: APP_COLORS['warning'],
            trackColor: false,
            scaleColor: false,
            lineWidth: 4,
            lineCap: 'circle'
        };
        $('#easypie2').easyPieChart(pieOptions2);

        var pieOptions3 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: APP_COLORS['danger'],
            trackColor: APP_COLORS['gray-light'],
            scaleColor: APP_COLORS['gray'],
            size: 200,
            lineWidth: 15,
            lineCap: 'circle'
        };
        $('#easypie3').easyPieChart(pieOptions3);

        var pieOptions4 = {
            animate: {
                duration: 800,
                enabled: true
            },
            barColor: APP_COLORS['danger'],
            trackColor: APP_COLORS['yellow'],
            scaleColor: APP_COLORS['gray-dark'],
            lineWidth: 10,
            lineCap: 'circle'
        };
        $('#easypie4').easyPieChart(pieOptions4);

    });

})(window, document, window.jQuery);
