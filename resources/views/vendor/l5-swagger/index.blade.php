<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('l5-swagger.documentations.' . $documentation . '.api.title') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}"
        sizes="16x16" />
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
					<button id="docs-sidebar-toggler" class="docs-sidebar-toggler docs-sidebar-visible me-2 d-xl-none" type="button">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </button>
	                <div class="site-logo"><a class="navbar-brand" href="../"><span class="logo-text">Global<span class="text-alt">Tongue Edu.</span></span></a></div>    
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

    <div id="swagger-ui"></div>

    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
    <script>
        window.onload = function() {
            // Build a system
            const ui = SwaggerUIBundle({
                dom_id: '#swagger-ui',
                url: "{!! $urlToDocs !!}",
                operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
                configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
                validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
                oauth2RedirectUrl: "{{ route('l5-swagger.' . $documentation . '.oauth2_callback', [], $useAbsolutePath) }}",

                requestInterceptor: function(request) {
                    request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                    return request;
                },

                // ... (other configuration)
            });

            window.ui = ui;
        }
    </script>

    <!-- Load React and Babel for your custom layout -->
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script type="text/babel">
        // Create the layout component
        class SidebarLayout extends React.Component {
            render() {
                const {
                    getComponent
                } = this.props
                const StandaloneLayout = getComponent("StandaloneLayout", true)
                const Operations = getComponent("operations", true)
                return (
                    <div>
                        {/* Custom navigation bar */}
                        <div className="custom-navigation">
                            <a href="#">Home</a>
                            <a href="#">Documentation</a>
                            <a href="#">About</a>
                            {/* Add more navigation links as needed */}
                        </div>
                        {/* Custom logo with link */}
                        <a href="https://your-website.com">
                            <div className="logo__img"></div>
                        </a>
                        <StandaloneLayout />
                    </div>
                )
            }
        }

        // Create the plugin that provides our layout component
        const SidebarLayoutPlugin = () => {
            return {
                components: {
                    SidebarLayout: SidebarLayout
                }
            }
        }
    </script>
</body>

</html>
