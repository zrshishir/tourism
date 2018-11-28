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
    
    <style>
        #accordion .panel-heading { padding: 0;}
        #accordion .panel-title > a {
            display: block;
            padding: 0.4em 0.6em;
            outline: none;
            font-weight:bold;
            text-decoration: none;
        }

        #accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
            content:"\e113";
            float: left;
            font-family: 'Glyphicons Halflings';
            margin-right :1em;
        }
        #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
            content:"\e114";
        }
    </style>
</head><!--/head-->

<body id="home" class="homepage">

<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
<!--                 <img style="height: 65px;" class="img-responsive" src="{{ asset('plugins/pricing/images/xCoder.jpeg') }}" alt="logo"> -->
                <h3>Postman</h3>
                </a>

            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="scroll {{ (Request::is('')) ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li class="scroll"><a href="#features">Features</a></li>
                    <li class="scroll"><a href="#services">Services</a></li>
                    <li class="scroll"><a href="#portfolio">Portfolio</a></li>
                    <li class="scroll"><a href="#about">About</a></li>
                    <li class="scroll"><a href="#meet-team">Team</a></li>
                    <li class="scroll"><a href="#pricing">Pricing</a></li>
                    <li class="scroll"><a href="#blog">Blog</a></li>
                    <li class="scroll"><a href="#get-in-touch">Contact</a></li>
                    <li class="scroll {{ (Request::is('faq')) ? 'active' : '' }}"><a href="{{ url('faq') }}">{{ trans('common.faq') }}</a></li>
                    <li class="scroll"><a href="{{url('login')}}">{{ trans('auth.log_in') }}</a></li>
                    <li class="scroll"><a href="{{url('register')}}">{{ trans('auth.Register') }}</a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->

<div class="container">
    <div class="row">
        <form action="{{ url('faq/search') }}" method="get">
            <div class="col-lg-3 pull-right">
                <div class="input-group custom-search-form">
                  <input type="text" name="searched_by" value="{{ ($request->has('searched_by')) ? $request->searched_by : '' }}" class="form-control" required="">
                  <span class="input-group-btn">
                  <button class="btn" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                 </span>
                 </div><!-- /input-group -->
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12" id="main">
            <h3 class="text-muted">
                @if($request->has('searched_by'))
                    Search Results
                @else
                    General Questions
                @endif
            </h3>
            <hr>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @forelse ($faqs as $key => $faq)
                  <div class="panel panel-default" style="border: 1px solid #ddd">
                    <div class="panel-heading" role="tab" id="faq_{{ $key }}" onclick="loadComment('{{ $faq->id }}')">
                      <h4 class="panel-title" style="background-color: #ddd">
                        <a class="{{ ($key != 0) ? 'collapsed' : ''}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{ $key }}" aria-expanded="{{ ($key == 0) ? true : false }}" aria-controls="collapse_{{ $key }}" style="padding: 0.6em 0.6em;">
                          {{ $faq->name }}
                        </a>
                      </h4>
                    </div>
                    <div id="collapse_{{ $key }}" class="panel-collapse collapse {{ ($key == 0) ? 'in' : '' }}" role="tabpanel" aria-labelledby="faq_{{ $key }}">
                      <div class="panel-body">
                        {!! $faq->faq !!}
                        <hr>
                        <div class="col-md-10 col-md-offset-1">
                            <?php $each_faq_url = url('faq/'. $faq->id); ?>
                            
                            <a style="cursor: pointer; display: none;" id="faq_comment_{{ $faq->id }}" onclick="loadDisqus(jQuery(this), 'faq_{{ $faq->id }}', '{{ $each_faq_url }}');">
                                
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                    <div style="text-align: center;">
                        <p>No Results Found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                &copy; 2017 xCoder.io Designed by <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>
            </div>
            <div class="col-sm-6">
                <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer><!--/#footer-->
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

<script>
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

<script type="text/javascript">
    $(function() {
        @if(count($faqs) > 0)
            $('#faq_comment_'+'{{ $faqs[0]->id }}').click();
        @endif
    });

    function loadComment(faq_id) {
        $('#faq_comment_'+faq_id).click();
    }

    var disqus_shortname = '{{ configValue("disqusShortname") }}';
    var disqus_identifier;
    var disqus_url;

    function loadDisqus(source, identifier, url) {

        if (window.DISQUS) {
           jQuery('#disqus_thread').insertAfter(source);
           /** if Disqus exists, call it's reset method with new parameters **/

            DISQUS.reset({
          reload: true,
          config: function () { 
           this.page.identifier = identifier.toString();    //important to convert it to string
           this.page.url = url;
          }
         });
        } else {
        //insert a wrapper in HTML after the relevant "show comments" link

           jQuery('<div id="disqus_thread"></div>').insertAfter(source);
           disqus_identifier = identifier; //set the identifier argument
           disqus_url = url; //set the permalink argument
           //append the Disqus embed script to HTML
           var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
           dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
           jQuery('head').append(dsq);
        }
    };

</script>

</body>
</html>