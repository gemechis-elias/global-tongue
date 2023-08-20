<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Introducation</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Bootstrap 4 Template For Software Startups">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('fontawesome/js/all.min.js')}}"></script>
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/simplelightbox/simple-lightbox.min.css ')}}">
 

    <script defer src="{{ asset('js/all.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/80af3c4fac.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="fav.png" rel="icon">
    <!-- Theme CSS -->   
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

</head> 

<body class="docs-page">    
    <header class="header fixed-top">	    
        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible me-2 d-xl-none" type="button">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </button>
	                <div class="site-logo"><a class="navbar-brand" href="../../"> <span class="logo-text">Global<span class="text-alt">Tongue Edu.</span></span></a></div>    
                </div><!--//docs-logo-wrapper-->
	            <div class="docs-top-utilities d-flex justify-content-end align-items-center">
	                <div class="top-search-box d-none d-lg-flex">
		                <form class="search-form">
				            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
				            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
				        </form>
	                </div>
	
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
    
    
    <div class="docs-wrapper">
	    <div id="docs-sidebar" class="docs-sidebar">
		    <div class="top-search-box d-lg-none p-3">
                <form class="search-form">
		            <input type="text" placeholder="Search the docs..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
		        </form>
            </div>
		    <nav id="docs-nav" class="docs-nav navbar">
			    <ul class="section-items list-unstyled nav flex-column pb-3">
				    <li class="nav-item section-title"><a class="nav-link scrollto active" href="#section-1"><span class="theme-icon-holder me-2"><i class="fas fa-map-signs"></i></span>Introduction</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-1-1">Section Item 1.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-2"><span class="theme-icon-holder me-2"><i class="fas fa-arrow-down"></i></span>Installation</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-2-1">Section Item 2.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-3"><span class="theme-icon-holder me-2"><i class="fas fa-box"></i></span>APIs</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-3-1">Section Item 3.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-4"><span class="theme-icon-holder me-2"><i class="fas fa-cogs"></i></span>Integrations</a></li>

			    </ul>

		    </nav><!--//docs-nav-->
	    </div><!--//docs-sidebar-->
	    <div class="docs-content">
		    <div class="container">
			    <article class="docs-article" id="section-1">
				    <header class="docs-header">
					    <h1 class="docs-heading">Introduction <span class="docs-time">Last updated: Aug 20, 2023</span></h1>
					    <section class="docs-intro">
						    <p>Welcome to the Global Tongue Education API Documentation! This API project is designed to empower both clients and administrators with a seamless educational experience. Built using the Laravel 9 framework, this API offers a range of functionalities to enhance learning processes</p>
						</section><!--//docs-intro-->
						
						<h5>Github Repo:</h5>
						<p>The Commits and change history of this API <a class="theme-link" href="#"  target="_blank">Found on this Github</a></p>
						<!-- <div class="docs-code-block"> -->
							<!-- ** Embed github code starts ** -->
							<!-- <script src="https://gist.github.com/xriley/fce6cf71edfd2dadc7919eb9c98f3f17.js"></script> -->
							<!-- ** Embed github code ends ** -->
						<!-- </div>//docs-code-block -->
						
					     <h5>Basic Info</h5>
						<!-- <p>You can <a class="theme-link" href="https://github.com/highlightjs/highlight.js" target="_blank">embed your code snippets using highlight.js</a> It supports <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">185 languages and 89 styles</a>.</p> -->
						<!-- <p>This template uses <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">Atom One Dark</a> style for the code blocks: <br><code>&#x3C;link rel=&#x22;stylesheet&#x22; href=&#x22;//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css&#x22;&#x3E;</code></p> -->
						<div class="docs-code-block">
							<pre class="shadow-lg rounded"><code class="json hljs">[
  {
    <span class="hljs-attr">"Name"</span>: <span class="hljs-string">"Global Tongue Edu"</span>,
    <span class="hljs-attr">"End Point"</span>: [<span class="hljs-link">https://api.globaltongueedu.com/v1/public/api/</span>],
    <span class="hljs-attr">"API Docs"</span>: <span class="hljs-link">https://api.globaltongueedu.com/v1/public/api/docs</span>
  },
]
</code></pre>
						</div><!--//docs-code-block-->
						
						
				    </header>
				 			    
			    <article class="docs-article" id="section-2">
				    <header class="docs-header">
					    <h1 class="docs-heading" id="item-2-1">Installation</h1>
					    <section class="docs-intro">
						    <p>Getting started with the Global Tongue Education API is straightforward. Follow these steps to set up the API in your development environment</p>
							<h3 >Prerequisites:</h3>
							<p>
PHP >= 8.0<br>
Composer (https://getcomposer.org/)<br>
Laravel CLI (https://laravel.com/docs/9.x/installation)<br></p>
<br>
1. Clone the repository from GitHub:

<pre class="shadow-lg rounded"><code class="bash hljs">
git clone https://github.com/gemechis-elias/global-tongue-api.git

</code></pre>

<br>
2. Install the project dependencies using Composer:

<pre class="shadow-lg rounded"><code class="bash hljs">
composer install

</code></pre>

<br>
3. Create a copy of the .env.example file and name it .env:

<pre class="shadow-lg rounded"><code class="bash hljs">
cp .env.example .env

</code></pre>

<br>
4. Generate a new application key:

<pre class="shadow-lg rounded"><code class="bash hljs">
php artisan key:generate

</code></pre>

<br>
5. Migrate and seed the database:

<pre class="shadow-lg rounded"><code class="bash hljs">
php artisan migrate --seed

</code></pre>

<br>
6. Start the development server:

<pre class="shadow-lg rounded"><code class="bash hljs">
php artisan serve

</code></pre>
						</section><!--//docs-intro-->
				    </header>
				     
			
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-3">
				    <header class="docs-header">
					    <h1 class="docs-heading">How to use APIs</h1>
					    <section class="docs-intro">
						    <p>The Global Tongue Education API provides a comprehensive set of endpoints to facilitate educational activities. For detailed information on available endpoints, request formats, and responses, please refer to the official API documentation:

<a href="https://api.globaltongueedu.com/v1/public/api/docs">https://api.globaltongueedu.com/v1/public/api/docs</a></p>
						</section><!--//docs-intro-->
				    </header>
				   
				 
			    </article><!--//docs-article-->
			    
			    <article class="docs-article" id="section-4">
				    <header class="docs-header">
					    <h1 class="docs-heading">Intergrations</h1>
					    <section class="docs-intro">
						    <p>
								
							Integrating the Global Tongue Education API into your preferred software development technology is simple. The API is versatile and can be seamlessly integrated with various frontend frameworks such as React, Next.js, Flutter, and more. To get started, follow these general steps:
							<br>
Obtain an API key by registering as a developer on the Global Tongue Education platform.
<br>
Refer to the official API documentation to understand the available endpoints and their functionalities.
<br>
Utilize your chosen frontend technology's networking capabilities to make API requests. Most frontend frameworks provide libraries or packages for handling HTTP requests.
<br>
Authenticate your requests using the provided API key, following the authentication guidelines outlined in the documentation.
<br>
Process the API responses and integrate them into your frontend application to enhance the learning experience.
<br>
With these steps, you can seamlessly integrate the Global Tongue Education API into your application and leverage its powerful features to enrich the educational journey.
<br>
Feel free to explore the API documentation to gain a deeper understanding of the available functionalities and start incorporating them into your projects. If you encounter any issues or have questions, our support team is here to assist you!
<br>
							</p>
						</section><!--//docs-intro-->
				    </header>
				  
				 
			    </article><!--//docs-article-->
			    
			    
			    
			   
			    
			    
			 
			    
			    
			   
					
					 
			    </article><!--//docs-article-->

			    <footer class="footer">
				    <div class="container text-center py-5">
			            <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="theme-link" href="#" target="_blank">Global Tongue Edu.</a> Developers</small>
				        <ul class="social-list list-unstyled pt-4 mb-0">
						    <li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li> 
				            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
				            <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
				           </ul><!--//social-list-->
				    </div>
			    </footer>
		    </div> 
	    </div>
    </div><!--//docs-wrapper-->
   
       
    <!-- Javascript -->          
    <script src="{{ asset('plugins/popper.min.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>  
    
    
    <!-- Page Specific JS -->
    <script src="{{ asset('plugins/smoothscroll.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="{{ asset('js/highlight-custom.js')}}"></script> 
    <script src="{{ asset('plugins/simplelightbox/simple-lightbox.min.js')}}"></script>      
    <script src="{{ asset('plugins/gumshoe/gumshoe.polyfills.min.js')}}"></script> 
    <script src="{{ asset('js/docs.js')}}"></script> 

</body>
</html> 

