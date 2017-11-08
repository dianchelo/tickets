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
                <li><a href="{{ route('login.facebook') }}" style="color:#fff;"><strong>Login<strong></a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top:0px;">
                        <img src="https://graph.facebook.com/v2.10/{{ Auth::user()->facebook_id }}/picture?type=small" class="img-circle"></a><span class="caret" style="float:right;margin-top:-50%;"></span>

                    <ul class="dropdown-menu" role="menu">
                        @if(Cart::count() > 0)
                        <li><a href="{{ route('cart.index') }}">View Cart</a></li>
                        @endif
                        <li><a href="#">My tickets for sale</a></li>
                        <li><a href="#">Purchased tickets</a></li>
                        
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
                <li><a href="{{ route('tickets.sell') }}" class="btn btn-gold btn-lg" role="button">Sell tickets</a></li>
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle btn btn-gray btn-lg" data-toggle="dropdown" role="button" aria-expanded="false" >Admin Tools</a>
                        

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('events.create') }}">Create Events</a></li>
                            <li><a href="{{ route('categories.index') }}">View/Create Categories</a></li>
                            <li><a href="{{ route('tags.index') }}">View/Create Tags</a></li>
                        </ul>
                </li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>