<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<style>
/*loader css*/
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  border-bottom: 16px solid #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

@include('partials.htmlheader')

<body class="skin-{!! configValue('sidebar_theme') ? configValue('sidebar_theme'):'red-light'!!} sidebar-mini">
    <!-- for loader spinner not used have to remove style -->
<div class="wrapper" id="body_content" style="opacity: 0.5">

    @include('partials.mainheader')

    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('partials.contentheader')

        <!-- Main content -->
        <section class="content">

            <?php $alert_type = ''; $msg = ''; ?>
            @if (Session::has('success_msg'))
            <?php $alert_type = 'success';
            $msg = Session::get('success_msg');
            Session::forget('success_msg');
            ?>
            @elseif(Session::has('error_msg'))
            <?php $alert_type = 'error';
            $msg = Session::pull('error_msg');
            ?>
            @elseif(Session::has('info_msg'))
            <?php $alert_type = 'info';
            $msg = Session::pull('info_msg');
            ?>
            @elseif(Session::has('warning_msg'))
            <?php $alert_type = 'warning';
            $msg = Session::pull('warning_msg');
            ?>
            @else
            <?php $alert_type = '';
            $msg = '';
            ?>
            @endif
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('partials.controlsidebar')

    @include('partials.footer')

</div><!-- ./wrapper -->

<!-- for loader spinner not used have to remove the below div -->
<div class="loader" style="position: fixed;
     left: 50%;
     top: 40%;
     display: block;
     z-index: 1800;
     height: 64px;
     width: 64px;">
</div>

@include('partials.scripts')

<script>
    //loading spinner start
    var $loading = $('.loader');

    $(window).bind("load", function () {
        $('#body_content').css('opacity', '1.0');
        $loading.hide();
    });


    $(document)
      .ajaxStart(function () {
        $('#body_content').css('opacity', '0.5');
        $loading.show();
      })
      .ajaxStop(function () {
        $('#body_content').css('opacity', '1.0');
        $loading.hide();
      });
      // end loading spinner


    $(function () {
        var alert_type = '<?php echo $alert_type; ?>';
        var msg = '<?php echo $msg; ?>';
        if((alert_type != '') && (msg != '')){
            Command: toastr[alert_type](msg);
            alert_type = '';
            msg = '';
        }
    });

</script>
</body>
</html>
