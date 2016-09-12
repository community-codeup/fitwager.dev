@extends ('layouts.master')
@section('content')
<br>

<hr style="border-top: 2px solid #e0e0e0">

<div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
    <div class="row">
            <div class="col-sm-3 text-center">
                <h3 style="text-transform: lowercase; color: dimgray">{{ $user->name }}</h3>
                <img class="text-center img-responsive center-block" style="padding:1px; border:1px solid #021a40; width:200px;height:200px"; src="{{ $user->picture }}">
            <br>
                <div style="border: 2px solid gold;
    display: inline-block;
    padding-right: 3%;
    padding-left: 3%;">
                    <h3><img src="/img/coins3.png" style="width: 50px; height: 50px"> {{ $user->coins }}</h3>
                </div>
            </div>
            <script>
                var graphInfo = {!! json_encode($graphInfo) !!};
            </script>
            <div class="col-sm-9" id="barChart" style="min-width: 200px; height: 400px; margin: 0 auto"></div>

    </div>
</div>

<hr style="border-top: 2px solid #e0e0e0">

    <br>

@endsection

