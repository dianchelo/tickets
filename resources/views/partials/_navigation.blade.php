    <!-- Default Bootstrap Navbar -->
    <nav class="navbar navbar-default" >
      <div class="container-fluid" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" id="dd">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/events">{{ Html::image('img/logo2-120px.png') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <!--- ELEMENTS FOR LATER USE 
          <ul class="nav navbar-nav">
            <li class={ Request::is('/') ? "active" : "" }}><a href="/">Home</a></li>
            <li class={ Request::is('/') ? "active" : "" }}><a href="/about">About</a></li>
            <li class={ Request::is('/') ? "active" : "" }}><a href="/contact">Contact</a></li>
            <li class={ Request::is('/') ? "active" : "" }}><a href="/events/create">Create Event</a></li>
          </ul>
          -->
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ route('login.facebook') }}">Login FB</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="">My tickets for sale</a></li>
                        <li><a href="">Purchased tickets</a></li>
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('tags.index') }}">Tags</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li><a href="/events/create" class="btn btn-green btn-lg" role="button">Create Event</a></li>
                <li><a href="/tickets/create" class="btn btn-gold btn-lg" role="button">Sell tickets</a></li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>