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
    <style>
        /* Modify primary color to red */
        .scheme-container .topbar-wrapper, .scheme-container .scheme-container-header {
            background-color: red;
        }


        /* Add custom navigation bar styles */
        .navigation {
	 height: 70px;
	 background: #333;
}
 .brand {
	 position: absolute;
	 padding-left: 20px;
	 float: left;
	 line-height: 70px;
	 text-transform: uppercase;
	 font-size: 1.4em;
}
 .brand a, .brand a:visited {
	 color: #fff;
	 text-decoration: none;
}
 .nav-container {
	 max-width: 1000px;
	 margin: 0 auto;
}
 nav {
	 float: right;
}
 nav ul {
	 list-style: none;
	 margin: 0;
	 padding: 0;
}
 nav ul li {
	 float: left;
	 position: relative;
}
 nav ul li a, nav ul li a:visited {
	 display: block;
	 padding: 0 20px;
	 line-height: 70px;
	 background: #333;
	 color: #fff;
	 text-decoration: none;
}
 nav ul li a:hover, nav ul li a:visited:hover {
	 background: #2581dc;
	 color: #fff;
}
 nav ul li a:not(:only-child):after, nav ul li a:visited:not(:only-child):after {
	 padding-left: 4px;
	 content: ' ▾';
}
 nav ul li ul li {
	 min-width: 190px;
}
 nav ul li ul li a {
	 padding: 15px;
	 line-height: 20px;
}
 .nav-dropdown {
	 position: absolute;
	 display: none;
	 z-index: 1;
	 box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
}
/* Mobile navigation */
 .nav-mobile {
	 display: none;
	 position: absolute;
	 top: 0;
	 right: 0;
	 background: #262626;
	 height: 70px;
	 width: 70px;
}
 @media only screen and (max-width: 798px) {
	 .nav-mobile {
		 display: block;
	}
	 nav {
		 width: 100%;
		 padding: 70px 0 15px;
	}
	 nav ul {
		 display: none;
	}
	 nav ul li {
		 float: none;
	}
	 nav ul li a {
		 padding: 15px;
		 line-height: 20px;
	}
	 nav ul li ul li a {
		 padding-left: 30px;
	}
	 .nav-dropdown {
		 position: static;
	}
}
 @media screen and (min-width: 799px) {
	 .nav-list {
		 display: block !important;
	}
}
 #nav-toggle {
	 position: absolute;
	 left: 18px;
	 top: 22px;
	 cursor: pointer;
	 padding: 10px 35px 16px 0px;
}
 #nav-toggle span, #nav-toggle span:before, #nav-toggle span:after {
	 cursor: pointer;
	 border-radius: 1px;
	 height: 5px;
	 width: 35px;
	 background: #fff;
	 position: absolute;
	 display: block;
	 content: '';
	 transition: all 300ms ease-in-out;
}
 #nav-toggle span:before {
	 top: -10px;
}
 #nav-toggle span:after {
	 bottom: -10px;
}
 #nav-toggle.active span {
	 background-color: transparent;
}
 #nav-toggle.active span:before, #nav-toggle.active span:after {
	 top: 0;
}
 #nav-toggle.active span:before {
	 transform: rotate(45deg);
}
 #nav-toggle.active span:after {
	 transform: rotate(-45deg);
}
 article {
	 max-width: 1000px;
	 margin: 0 auto;
	 padding: 10px;
}
 
    </style>
</head>

<body>
<section class="navigation">
  <div class="nav-container">
    <div class="brand">
      <a href="#!">Backend - Global Tongue</a>
    </div>
    <nav>
      <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
      <ul class="nav-list">
        <li>
          <a href="../../">Home</a>
        </li>
        <li>
          <a href="https://github.com/gemechis-elias/global-tongue/commit/">Change Log</a>
        </li>
    
        <li>
          <a href="https://github.com/gemechis-elias/global-tongue/tree/main">Github</a>
        </li>
      </ul>
    </nav>
  </div>
</section>

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
