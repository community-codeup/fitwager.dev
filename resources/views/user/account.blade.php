@extends ('layouts.master')
@section('content')
<br>

<hr style="border-top: 2px solid #e0e0e0">

<div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
    <div class="row">
            <div class="col-sm-3 text-center">
                <h3 style="text-transform: lowercase; color: dimgray">{{ $user->name }}</h3>
                <img class="text-center img-responsive center-block" style="padding:1px; border:1px solid #021a40; width:200px;height:200px"; src="{{ $user->picture }}">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li><h4 style="color: dimgrey">fitbit id: {{ $user->fitbit_id }}</h4></li>
                    </ul>
                <h3><img src="/img/coins3.png" style="width: 100px; height: 100px"> = {{ $user->coins }}</h3>
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

