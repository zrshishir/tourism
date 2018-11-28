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

<div class="container" id="root">
    <div class="col-md-12 col-lg-12">
        <input type="text" v-model="keywords" placeholder="search" :list="fetchTitles">
        <datalist :id="fetchTitles">
            <option v-for="title in titles" :value="title"></option>
        </datalist>
        <button v-on:click="fetchTitles">search</button>
    </div>
   
     <div class="col-md-12 col-lg-12" >
       
            <div class="col-md-1" v-for='result in results'>

                <a href="#" class="thumbnail">
                        @{{result.title}}
                        <img :src="urlBase + '/' + result.path"  :alt="result.title">
                </a>
            </div>
            <!-- <ul>
                <li v-for='result in results'>@{{ result }}</li>
            </ul> -->
     </div>

            
           

           
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        var urlB = "{{ url('upload')}}";
         new Vue({
            el: "#root",
            data: {
                keywords: '',
                results: [],
                titles:[],

                urlBase: urlB
            }, 
            watch:{
                keywords(after, before) {
                    this.fetch();
                    if(this.keywords.length > 3){
                        this.fetchTitles();
                    }
                    
                }
            },
            created(){
                this.fetch();
            },
            methods:{
                fetch(){
                    axios.get('allFiles',{ params: { keywords: this.keywords}})
                        .then(response => this.results = response.data)
                        .catch(error => {});
                },

                fetchTitles(){
                    axios.get('allTitles')
                        .then(response => this.titles = response.data)
                        .catch(error => {});
                },
                urlContcate(result){
                    return urlB +'/'+ result ;
                }
            }
        });
    </script>




</body>
</html>