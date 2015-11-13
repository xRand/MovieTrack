<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::to('') }}">MovieTracker</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ URL::to('') }}">Home</a></li>
                <li><a href="film/22">abc</a></li>
                <li><a href="">abc</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    {{--adminpanel--}}
                    @if(Auth::user()->isAnAdmin())
                        <li><a href="{{ URL::to('admin/admin_panel') }}">Admin Panel</a></li>
                    @endif


                    <li><a href=""><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
                    <li><a href="{{ URL::to('auth/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                @else
                    <li><a href="{{ URL::to('auth/authorization') }}"><span class="glyphicon glyphicon-user"></span> Log in</a></li>
                    <li><a href="{{ URL::to('auth/registration') }}"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>