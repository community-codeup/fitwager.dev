@extends ('layouts.master')

@section('content')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a class="navbar-brand" id="navButtons" href="#">Home</a></li>
                        <li><a class="navbar-brand" id="navButtons" href="#">Account</a></li>
                        <li><a class="navbar-brand" id="navButtons" href="#">Create Challenge</a></li>
                        <li><a class="navbar-brand" id="navButtons" href="#">Coins</a></li>
                    </ul>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="navbar-brand" href="#">Logout</a></li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

@endsection
