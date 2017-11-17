@include('backend.layouts.header')

<header class="main-header">

    <a href="" class="logo">
        <span class="logo-mini"><b>EP</b></span>
        <span class="logo-lg"><b>English API</b></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        @include('backend.layouts.menu')
    </nav>

</header>

<aside class="main-sidebar">
    @include('backend.layouts.leftbar')
</aside>

@yield('content')

@include('backend.layouts.footer')