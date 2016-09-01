@extends('layouts.master')
@section('content')
@extends ('layouts.master')

@section('content')

    <body background="/img/night1.jpg" style="background-color: black;
      webkit-background-size: cover; moz-background-size: cover; o-background-size: cover; background-size: cover">
        <div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
                <div class='row'>
                    <div class="col-sm-3" id="header">
                        <h1 style="font-size: 55px; color: whitesmoke; font-weight: bold; text-decoration: underline">ACCOUNT</h1><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <img class="text-center img-responsive center-block" style="padding:1px; border:1px solid #021a40; width:200px;height:200px"; img src="http://placehold.it/200x200">
                            <br>
                        </div>
                        <a href="challenges/results"></a>
                    </div>
                    <div class="col-sm-3"><h1>Challenges Results</h1>
                        <!-- <ul class="text-center">
                            <li>Contact Name</li>
                            <li>Phone Number</li>
                        </ul> -->
                        <table id="results" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="row">Created By</th>
                                    <th scope="row">Bet Type</th>
                                    <th scope="row">Challenge Type</th>
                                    <th scope="row">Challengers</th>
                                    <th scope="row">Coins Won</th>
                                </tr>
                            </thead>
                            <tbody class=""></tbody>
                        </table><br>

                        <button class="refresh" class="btn btn-success">Load Historic</button>
                        <button class="refresh" class="btn btn-success">Load Future</button>
                    </div>
                </div>
        </div>
    </body>
@stop
<script>

</script> 

