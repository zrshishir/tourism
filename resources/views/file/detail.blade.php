<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Parallax Template - Materialize</title>

  <!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('plugins/file/css/materialize.css') }}" rel="stylesheet" media="screen,projection">
  <link href="{{ asset('plugins/file/css/style.css') }}" rel="stylesheet" media="screen,projection">
</head>
<body>
<div id="app">
<div class="navbar-fixed">

<ul id="dropdown1" class="dropdown-content">
	<li v-for="tag in tags" :value="tag.id" v-on:click="fetchData(tag.id)"><a href="">@{{ tag.name }}</a></li>
</ul>
	<nav class="white">
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo">Logo</a>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			
			<ul class="right hide-on-med-and-down">
				<li><a href="sass.html">Collection</a></li>
				<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Tags<i class="material-icons right">arrow_drop_down</i></a></li>
				<li><a href="#"><a class=" btn-small file-field input-field white">submit a photo</a></a></li>
				<li><a href="#">Login</a></li>
				<a class="waves-effect waves-light btn ">join free</a>
			</ul>

			<form class=" hide-on-med-and-down" id="form1" >
			<div class="input-field" style="max-width: 400pt;">
				<input id="search" type="search" placeholder="Search free photos" onkeyup="getBlogs(this.value,0);">
				<label class="label-icon" for="search" ><i class="material-icons">search</i></label>
				<!-- <i class="material-icons">close</i> -->
				<div id="searchResults" ></div>
			</div>
		</form>

		</div>
	</nav>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="sass.html">Sass</a></li>
		<li><a href="badges.html">Components</a></li>
		<li><a href="collapsible.html">Javascript</a></li>
		<li><a href="mobile.html">Mobile</a></li>
	</ul>
</div>




    	<div class="container">
    		<div class="row">
    			<div class="col s12 m9">
    				 <img class="responsive-img" :src="urlBase + '/' + mainImage.path" :alt="mainImage.title">
    				 <div class="row">
    				 		<h4 style="margin-left: 1%;">Related Images</h4>
    				 	<div class="col s6 m4" v-for="result in results">
    				 		<img class="responsive-img"  :src="urlBase + '/' + result.path" :alt="result.title">
    				 	</div>
    				 </div>
    			</div>
    			<div class="col s12 m3">
    				 <div class="card horizontal remove_shadow">
				      
				      <div class="card-stacked">
				        <div class="card-content">
				          <a class="waves-effect waves-light btn-small white"  style="color:#000;"><i class="material-icons left" style="color:red" >favorite</i>112</a>
				          <!-- <a class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>112</a> -->
				          <a class="waves-effect waves-light btn-small white " style="color:#ccc;"><i class="material-icons left ">star</i>140</a>
				          <a class="waves-effect waves-light btn-small grey"><i class="material-icons">share</i></a>
				        </div>
				        <div class="card-action">
				          <a class="waves-effect waves-light btn-small" style="padding: 0% 20%;background:#3AA55A;"><i class="material-icons left">file_download</i>Free Download</a>
				          
				        <div class="card-action">
				        	<a href="#" style="color:#636363;text-decoration:underline">CC0 Creative Commons</a>
				          	<div style="margin-top:4px;font-size:14px">
				                Free for commercial use
				                <br>No attribution required
			            	</div>
				        </div>
				        </div>
				        <div class="card-action">
				          <div style="margin-top:4px;font-size:14px">
				                Stay with Facebook
			            	</div>
				          <a class="waves-effect waves-light btn-small  light-blue darken-4"><i class="material-icons left">thumb_up</i>Like 112</a>
				          <a class="waves-effect waves-light btn-small  light-blue darken-4">Share</a>
				        </div>

				      </div>
				    </div>
				    <div class="row">
				    	<div class="col s12 m12">
    				 		sponsord images
				    	</div>
				    	<div class="col s6 m6" v-for="result in results">
    				 		<img class="responsive-img" :src="urlBase + '/' + result.path" :alt="result.title">
				    	</div>
				    	<div class="col s12 m12">
    				 		<a class="waves-effect waves-light btn-small grey" style="padding: 0% 32%;">Similar Images</a>
				    	</div>
				    </div>
    			</div>
    		</div>
	     <br><br>
	    </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="http://ctmt-ltd.com">CTMT LTD.</a>
      </div>
    </div>
  </footer>
	</div>


  <!--  Scripts-->
	<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{ asset('plugins/file/js/materialize.js') }}"></script>
  <script src="{{ asset('plugins/file/js/init.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
	<script>

		var urlB = "{{ url('upload')}}";
		var imageId = "{{ $id }} ";

		new Vue({
			el: "#app",
			data: {
					keywords: '',
					results: [],
					mainImage: '',
					titles:[],
					tags: [],
					urlBase: urlB,
					imageId: imageId,
			}, 
			watch:{
					keywords(after, before) {
							// this.fetch();
							// if(this.keywords.length > 3){
							// 		this.fetchTitles();
							// }
							
					}
			},
		 
			created(){
					this.fetchMainImage();
					this.fetchRelatedImage();
					// this.fetch();
					this.fetchTags();
			},
			methods:{
					fetchMainImage(){
						axios.get('mainImage',{ params: { imageId: this.imageId}})
									.then(response => this.mainImage = response.data)
									.catch(error => {});
					},

					fetchRelatedImage(){
						axios.get('relatedImage',{ params: { imageId: this.imageId}})
									.then(response => this.results = response.data)
									.catch(error => {});
					},
					// fetch(){
					// 		axios.get('allFiles',{ params: { keywords: this.keywords}})
					// 				.then(response => this.results = response.data)
					// 				.catch(error => {});
					// },

//fetching tag images
					// fetchData(id){
					// 	axios.get('allData',{ params: { tagId: id}})
					// 				.then(response => this.results = response.data)
					// 				.catch(error => {});
					// },

					// fetchTitles(){
					// 		axios.get('allTitles')
					// 				.then(response => this.titles = response.data)
					// 				.catch(error => {});
					// },
					// urlContcate(result){
					// 		return urlB +'/'+ result ;
					// }, 

					// scroll(results){
					// 	window.onscroll = () => {
					// 		let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight >= (document.documentElement.offsetHeight - 200);
					// 		axios.get('allFiles',{ params: { dataLength: this.results.length}})
					// 				.then(response => {
					// 					if(response.data[0]){
					// 						this.results.push(response.data[0])
					// 					}
					// 				})
					// 				.catch(error => {});
					// 		console.log(bottomOfWindow);
					// 	};
					// },

					fetchTags(){
						axios.get('allTags')
									.then(response => this.tags = response.data)
									.catch(error => {});
					},
					// imgUrl(id){
					// 	console.log(id);
					// 	return this.urlBase + "/file/" + id;
					// }
			},
			mounted(){
				// this.scroll(this.results);
			}
	});
</script>

  </body>
</html>
