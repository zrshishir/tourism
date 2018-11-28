<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="email marketing web application">
    <meta name="author" content="xCoder.io">
    <title>Postman Email marketing Web Application</title>
    <!-- core CSS -->
    <link href="{{ asset('plugins/pricing/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- toastr -->
    <link href="{{ asset('/css/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/pricing/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pricing/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('plugins/pricing/js/html5shiv.js') }}"></script>
    <script src="{{ asset('plugins/pricing/js/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('plugins/pricing/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('plugins/pricing/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('plugins/pricing/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>

<div class="row">
    <div class="col-md-12">
        <form class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail3">Email address</label>
                <input type="search" class="form-control" id="exampleInputEmail3" placeholder="Email">
            </div>
            
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</div>

<div class="row">

    <div class="col-md-12 col-lg-12" >

        @foreach($allFiles as $file)
            <div class="col-md-1">

                
                <a href="#" class="thumbnail">
                    {!! $file->title !!}
                    <img src="{{url('upload/' . $file->path)}}" alt='{{"$file->title"}}'>
                </a>
    
            </div>
        @endforeach

    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12" id="files">

    </div>
</div>

    
      




<script src="{{ asset('plugins/pricing/js/jquery.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/bootstrap.min.js') }}"></script>
<!-- Bootstrap toastr -->
<script src="{{ asset('/js/toastr.min.js') }}" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('plugins/pricing/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/mousescroll.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/smoothscroll.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/jquery.isotope.min.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/jquery.inview.min.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/wow.min.js') }}"></script>
<script src="{{ asset('plugins/pricing/js/main.js') }}"></script>
<style>
/* <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> */
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
</style>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> -->
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
   
     
      $.ajaxSetup({
        async: false
        });
    
        $('#files').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('allFiles') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"},
                    
                   },
           
                
        });
        $.ajaxSetup({
        async: true
        });

        callEditableBootstrap();
        deleteSwl();
    });

    $(function(){

        $( document ).ajaxComplete(function() {
            callEditableBootstrap();
            deleteSwl();
        });

       
    });
</script>

</body>
</html>