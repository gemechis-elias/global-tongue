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
	                <div class="site-logo"><a class="navbar-brand" href="../"> <span class="logo-text">Global<span class="text-alt">Tongue Edu.</span></span></a></div>    
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
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-4-1">Section Item 4.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-5"><span class="theme-icon-holder me-2"><i class="fas fa-tools"></i></span>Utilities</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-5-1">Section Item 5.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-6"><span class="theme-icon-holder me-2"><i class="fas fa-laptop-code"></i></span>Web</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-6-1">Section Item 6.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-7"><span class="theme-icon-holder me-2"><i class="fas fa-tablet-alt"></i></span>Mobile</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-7-1">Section Item 7.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-8"><span class="theme-icon-holder me-2"><i class="fas fa-book-reader"></i></span>Resources</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-8-1">Section Item 8.1</a></li>
				    <li class="nav-item section-title mt-3"><a class="nav-link scrollto" href="#section-9"><span class="theme-icon-holder me-2"><i class="fas fa-lightbulb"></i></span>FAQs</a></li>
				    <li class="nav-item"><a class="nav-link scrollto" href="#item-9-1">Section Item 9.1</a></li>
			    </ul>

		    </nav><!--//docs-nav-->
	    </div><!--//docs-sidebar-->
	    <div class="docs-content">
		    <div class="container">
			    <article class="docs-article" id="section-1">
				    <header class="docs-header">
					    <h1 class="docs-heading">Introduction <span class="docs-time">Last updated: 2019-06-01</span></h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
						
						<h5>Github Code Example:</h5>
						<p>You can <a class="theme-link" href="https://gist.github.com/"  target="_blank">embed your code snippets using Github gists</a></p>
						<div class="docs-code-block">
							<!-- ** Embed github code starts ** -->
							<script src="https://gist.github.com/xriley/fce6cf71edfd2dadc7919eb9c98f3f17.js"></script>
							<!-- ** Embed github code ends ** -->
						</div><!--//docs-code-block-->
						
					     <h5>Highlight.js Example:</h5>
						<p>You can <a class="theme-link" href="https://github.com/highlightjs/highlight.js" target="_blank">embed your code snippets using highlight.js</a> It supports <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">185 languages and 89 styles</a>.</p>
						<p>This template uses <a class="theme-link" href="https://highlightjs.org/static/demo/" target="_blank">Atom One Dark</a> style for the code blocks: <br><code>&#x3C;link rel=&#x22;stylesheet&#x22; href=&#x22;//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css&#x22;&#x3E;</code></p>
						<div class="docs-code-block">
							<pre class="shadow-lg rounded"><code class="json hljs">[
  {
    <span class="hljs-attr">"title"</span>: <span class="hljs-string">"apples"</span>,
    <span class="hljs-attr">"count"</span>: [<span class="hljs-number">12000</span>, <span class="hljs-number">20000</span>],
    <span class="hljs-attr">"description"</span>: {<span class="hljs-attr">"text"</span>: <span class="hljs-string">"..."</span>, <span class="hljs-attr">"sensitive"</span>: <span class="hljs-literal">false</span>}
  },
  {
    <span class="hljs-attr">"title"</span>: <span class="hljs-string">"oranges"</span>,
    <span class="hljs-attr">"count"</span>: [<span class="hljs-number">17500</span>, <span class="hljs-literal">null</span>],
    <span class="hljs-attr">"description"</span>: {<span class="hljs-attr">"text"</span>: <span class="hljs-string">"..."</span>, <span class="hljs-attr">"sensitive"</span>: <span class="hljs-literal">false</span>}
  }
]


</code></pre>
						</div><!--//docs-code-block-->
						
						
				    </header>
				 			    
			    <article class="docs-article" id="section-2">
				    <header class="docs-header">
					    <h1 class="docs-heading">Installation</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-2-1">
						<h2 class="section-heading">Section Item 2.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
			
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-3">
				    <header class="docs-header">
					    <h1 class="docs-heading">APIs</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				   
				 
			    </article><!--//docs-article-->
			    
			    <article class="docs-article" id="section-4">
				    <header class="docs-header">
					    <h1 class="docs-heading">Intergrations</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-4-1">
						<h2 class="section-heading">Section Item 4.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
				 
			    </article><!--//docs-article-->
			    
			    <article class="docs-article" id="section-5">
				    <header class="docs-header">
					    <h1 class="docs-heading">Utilities</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-5-1">
						<h2 class="section-heading">Section Item 5.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					 
			    </article><!--//docs-article-->
			    
			    
		        <article class="docs-article" id="section-6">
				    <header class="docs-header">
					    <h1 class="docs-heading">Web</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-6-1">
						<h2 class="section-heading">Section Item 6.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					 
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-7">
				    <header class="docs-header">
					    <h1 class="docs-heading">Mobile</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-7-1">
						<h2 class="section-heading">Section Item 7.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
				 
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-8">
				    <header class="docs-header">
					    <h1 class="docs-heading">Resources</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque finibus condimentum nisl id vulputate. Praesent aliquet varius eros interdum suscipit. Donec eu purus sed nibh convallis bibendum quis vitae turpis. Duis vestibulum diam lorem, vitae dapibus nibh facilisis a. Fusce in malesuada odio.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-8-1">
						<h2 class="section-heading">Section Item 8.1</h2>
						<p>Vivamus efficitur fringilla ullamcorper. Cras condimentum condimentum mauris, vitae facilisis leo. Aliquam sagittis purus nisi, at commodo augue convallis id. Sed interdum turpis quis felis bibendum imperdiet. Mauris pellentesque urna eu leo gravida iaculis. In fringilla odio in felis ultricies porttitor. Donec at purus libero. Vestibulum libero orci, commodo nec arcu sit amet, commodo sollicitudin est. Vestibulum ultricies malesuada tempor.</p>
					</section><!--//section-->
					
					 
			    </article><!--//docs-article-->
			    
			    
			    <article class="docs-article" id="section-9">
				    <header class="docs-header">
					    <h1 class="docs-heading">FAQs</h1>
					    <section class="docs-intro">
						    <p>Section intro goes here. You can list all your FAQs using the format below.</p>
						</section><!--//docs-intro-->
				    </header>
				     <section class="docs-section" id="item-9-1">
						<h2 class="section-heading">Section Item 9.1 <small>(FAQ Category One)</small></h2>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>What's sit amet quam eget lacinia?</h5>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>How to ipsum dolor sit amet quam tortor?</h5>
						<p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Can I  bibendum sodales?</h5>
						<p>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. </p>
						<h5 class="pt-3"><i class="fas fa-question-circle me-1"></i>Where arcu sed urna gravida?</h5>
						<p>Aenean et sodales nisi, vel efficitur sapien. Quisque molestie diam libero, et elementum diam mollis ac. In dignissim aliquam est eget ullamcorper. Sed id sodales tortor, eu finibus leo. Vivamus dapibus sollicitudin justo vel fermentum. Curabitur nec arcu sed urna gravida lobortis. Donec lectus est, imperdiet eu viverra viverra, ultricies nec urna. </p>
					</section><!--//section-->
				 
					
					 
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

