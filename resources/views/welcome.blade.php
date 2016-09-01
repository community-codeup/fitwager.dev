

    @extends ('layouts.master')

    @section('content')


        {{-- BEGINNING OF PAGINATION --}}

        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
            <!-- Overlay -->

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#bs-carousel" data-slide-to="1"></li>
                <li data-target="#bs-carousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-1">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>We are Fit<span style="color: limegreen">Wager</span></h1>
                            <h3>Challenge Others In Your Area Today</h3>
                        </hgroup>
                        <button class="btn btn-hero btn-lg" role="button">See all features</button>
                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-2">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>Start Earning Wager Coins Today</h1>
                            <h3>Get start your next awesome project</h3>
                        </hgroup>
                        <button class="btn btn-hero btn-lg" role="button">See all features</button>
                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-3">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>Log in to Your FitBit Account Here</h1>
                            <h3>Get start your next awesome project</h3>
                        </hgroup>
                        <button class="btn btn-hero btn-lg" role="button">See all features</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- END OF PAGINATION --}}

        {{-- START LEADERBOARD COLUMNS --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h1 class="text-center">LEADERBOARD</h1></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <section id="content">
                    <h2>1st Content Area</h2>
                    <p>This page demonstrates a 3 column responsive layout, complete with responsive images and jquery slideshow.</p>
                </section>
            </div>
            <div class="col-md-4">
                <section id="middle">
                    <h2>2nd Content Area</h2>
                    <p>At full width all three columns will be displayed side by side. As the page is resized the third column will collapse under the first and second. At the smallest screen size all three columns will be stacked on top of one another.</p>
                    <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                </section>
            </div>
            <div class="col-md-4">
                <aside id="sidebar">
                    <h2>3rd Content Area</h2>
                    <p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                </aside>
            </div>
        </div>
    </div>


    @endsection
