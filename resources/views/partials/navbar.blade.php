@if (Auth::user())
<nav class="navbar navbar-default nav-center">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse" aria-expanded="false">
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
                    <li><a class="navbar-brand" id="navButtons" href="/">
                            <img src="/img/logo12.png"
                                 style="margin-top: -9px;"
                                 alt="Fitwager Logo">
                        </a><span class="navbar-brand">|</span>
                    </li>
                        <li><a class="navbar-brand" id="navButtons" href="/user/account">account</a><span
                                    class="navbar-brand">|</span></li>
                        <li><a class="navbar-brand" id="navButtons" href="/challenges/create">create challenge</a><span
                                    class="navbar-brand">|</span></li>
                        <li><a class="navbar-brand" id="navButtons" href="/challenges">my challenges</a><span
                                    class="navbar-brand">|</span></li>
                        <li><a class="navbar-brand" id="navButtons" href="/about">about</a><span
                                class="navbar-brand">|</span></li>
                        <li>
                             <a class="navbar-brand btn btn-lg btn-link" id="navButtons" href="/challenges">

                                <span id="envelope" class="glyphicon glyphicon-envelope"></span>
                                <span class="badge badge-notify">{{ Auth::user()->challengeCount() }}</span>
                            </a>
                        </li>
                </ul>
            </form>
            <ul class="nav navbar-nav navbar-right">
                    <li><a class="navbar-brand" href="/auth/logout">logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@endif