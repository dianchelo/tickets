<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials._head')
</head>

  <body class="">
  <div class="@yield('topclass')">
    @include('partials._navigation')
    @yield('topcontainer')
  </div>
    <div class="container @yield('containerclass')">
      @include('partials._messages')

      @yield('content')

      

    </div>

    @include('partials._footer')
    <!-- end of .container -->

    @include('partials._javascripts')

    @yield('scripts')

  </body>

</html>