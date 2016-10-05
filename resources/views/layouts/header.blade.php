<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
            E Learning System
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::check() && Auth::user()->isAdmin() == false)
                    <li><a href="{{ url('/home') }}">HOME</a></li>
                    <li><a href="{{ url('/word') }}">WORD</a></li>
                    <li><a href="{{ url('/category') }}">CATEGORY</a></li>
                    <li><a href="{{ url('/lesson') }}">LESSON</a></li>
                    <li><a href="{{ url('/') }}">USERS</a></li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href='/user/{{Auth::user()->id}}'><i class="fa fa-btn fa-user"></i>Profile</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        <li><a href="{{ url('/update_password') }}"><i class="fa fa-btn fa-edit"></i>Change Password</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
