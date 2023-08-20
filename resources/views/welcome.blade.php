<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <title>Global Tongue Documentation </title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('js/all.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/80af3c4fac.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="fav.png" rel="icon">
    <!-- Theme CSS -->   
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    
 

</head> 

<body>    
    <header class="header fixed-top">	 
	       
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
	                <div class="site-logo"><a class="navbar-brand" href="#"><span class="logo-text">Global<span class="text-alt">Tongue Edu.</span></span></a></div>    
                </div><!--//docs-logo-wrapper-->
	            <div class="docs-top-utilities d-flex justify-content-end align-items-center">
	
					<ul class="social-list list-inline mx-md-3 mx-lg-5 mb-0 d-none d-lg-flex">
						<li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
		                <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
		                <li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
		            </ul><!--//social-list-->
		            <a href="#" class="btn btn-primary d-none d-lg-flex">Logout</a>
	            </div><!--//docs-top-utilities-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->
    
    
    <div class="page-header theme-bg-dark py-5 text-center position-relative">
	    <div class="theme-bg-shapes-right"></div>
	    <div class="theme-bg-shapes-left"></div>
	    <div class="container">
		    <h1 class="page-heading single-col-max mx-auto">Documentation</h1>
		    <div class="page-intro single-col-max mx-auto">Official API and Backend Documentation for GlobalTongue Edu Project</div>
		    <div class="main-search-box pt-3 d-block mx-auto">
                 <form class="search-form w-100">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
             </div>
	    </div>
    </div><!--//page-header-->
   <div class="page-content">
	    <div class="container">
		    <div class="docs-overview py-5">
			    <div class="row justify-content-center">
				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-map-signs"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Introduction</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
							    </div>
                                <!-- Route to /intro -->
							    <a class="card-link-mask" href="{{ route('intro') }}"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
				    
				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-box fa-fw"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">APIs</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="{{ route('l5-swagger.default.api') }}"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
				  
                    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
								        <i class="fas fa-database fa-fw"></i>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">Database</span>
							    </h5>
							    <div class="card-text">
								    Section overview goes here. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.						    
								</div>
							    <a class="card-link-mask" href="{{ route('l5-swagger.default.api') }}"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
				    
				    
				   
				  
			    </div><!--//row-->
		    </div><!--//container-->
		</div><!--//container-->
    </div><!--//page-content-->

    <section class="cta-section text-center py-5 theme-bg-dark position-relative">
	    <div class="theme-bg-shapes-right"></div>
	    <div class="theme-bg-shapes-left"></div>
	    <div class="container">
		    <h3 class="mb-2 text-white mb-3">Integrated with Git Version Control </h3>
		    <div class="section-intro text-white mb-3 single-col-max mx-auto">This project is depolyed on github and hosted on HahuCloud </div>
		    <div class="pt-3 text-center">
			    <a class="btn btn-light" href="#">Github <i class="fas fa-arrow-alt-circle-right ml-2"></i></a>
		    </div>
	    </div>
    </section><!--//cta-section-->

    <footer class="footer">

	    <div class="footer-bottom text-center py-5">
		    
		    <ul class="social-list list-unstyled pb-4 mb-0">
			    <li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li> 
	            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
	             </ul><!--//social-list-->
	        
            <small class="copyright">Developed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by GlobalTongue Edu. Developers</a> </small>
            
	        
	    </div>
	    
    </footer>
       
    <!-- Javascript -->          
    <script src="{{ asset('plugins/popper.min.js') }} "></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
    
    <!-- Page Specific JS -->
    <script src="{{ asset('plugins/smoothscroll.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="{{ asset('js/highlight-custom.js') }}"></script> 
    <script src="{{ asset('plugins/simplelightbox/simple-lightbox.min.js') }}"></script>      
    <script src="{{ asset('plugins/gumshoe/gumshoe.polyfills.min.js') }}"></script> 
    <script src="{{ asset('js/docs.js') }}"></script> 

</body>
</html> 

