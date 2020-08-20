<!DOCTYPE html>
<html  lang="en" >

<head>
 @include("layouts.partials.head")
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">

    <div id="app">
        @include("layouts.partials.nav")
        <div class="container-fluid">
            <div class="page-wrapper">
                <div class="container-fluid">

                    <div >
                        @yield('content')
                    </div>
                </div>


            </div>
        </div>

        <footer-component></footer-component>
    </div>



<script src="{{ asset('js/app.js') }}" ></script>
@yield('js');
</body>
</html>